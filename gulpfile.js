var modules;

// install all the modules you need with npm install $module --save
modules = {};
modules.concat = require("gulp-concat");
modules.less = less = require("gulp-less");
modules.minify = require("gulp-minify-css");
modules.uglify = require("gulp-uglify");

// you don't need to edit anything below this line ----------------------

var config, env, fs, gassetic, gulp, gutil, jsYaml, less, modules, yargs;

fs = require("fs");
gulp = require("gulp");
gutil = require("gulp-util");
jsYaml = require("js-yaml");
yargs = require("yargs");
gassetic = require("gassetic");

// load the config
config = jsYaml.safeLoad(fs.readFileSync('gassetic.yml', 'utf8'));

env = yargs.argv.env || 'prod';

gulp.task('default', function() {
    var ga = new gassetic(config, 'dev', modules);
    ga.clean().then(function() {
        ga.build().then(function() {
            ga.watch();
        });
    });
});

gulp.task('build', function() {
    var ga = new gassetic(config, env, modules);
    ga.clean().then(function() {
        ga.build();
    });
});

gulp.task('clean', function() {
    var ga = new gassetic(config, env, modules);
    ga.clean();
});