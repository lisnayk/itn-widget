// Generated on 2016-07-02 using generator-angular 0.15.1
'use strict';

var gulp = require('gulp');
var $ = require('gulp-load-plugins')();
var openURL = require('open');
var lazypipe = require('lazypipe');
var rimraf = require('rimraf');
var wiredep = require('wiredep').stream;
var runSequence = require('run-sequence');

//app directory structor
var yeoman = {
    app: require('./bower.json').appPath || 'app',
    dist: 'dist',
    temp: '.tmp',
    test: 'test'
};

var paths = {
    scripts: [yeoman.app + '/scripts/**/*.js'],
    styles: [yeoman.app + '/styles/**/*.css'],
    test: ['test/spec/**/*.js'],
    testRequire: [
        yeoman.app + '/bower_components/angular/angular.js',
        yeoman.app + '/bower_components/angular-mocks/angular-mocks.js',
        yeoman.app + '/bower_components/angular-resource/angular-resource.js',
        yeoman.app + '/bower_components/angular-cookies/angular-cookies.js',
        yeoman.app + '/bower_components/angular-sanitize/angular-sanitize.js',
        yeoman.app + '/bower_components/angular-route/angular-route.js',
        'test/mock/**/*.js',
        'test/spec/**/*.js'
    ],
    karma: 'karma.conf.js',
    views: {
        main: yeoman.app + '/index.html',
        bowermain: yeoman.temp + '/index.html',
        files: [yeoman.app + '/views/**/*.html'],
        jade: [yeoman.app + '/views/**/*.jade']
    }
};

////////////////////////
// Reusable pipelines //
////////////////////////

var lintScripts = lazypipe()
    .pipe($.jshint, '.jshintrc')
    .pipe($.jshint.reporter, 'jshint-stylish');

var styles = lazypipe()
    .pipe($.autoprefixer, 'last 1 version')
    .pipe(gulp.dest, yeoman.temp + '/styles');

var jade = lazypipe()
    .pipe($.jade, {
        pretty: true
    });

var jade_tmp = lazypipe()
    .pipe(jade)
    .pipe(gulp.dest, yeoman.temp + "/views");

/*var jade_dist = lazypipe()
    .pipe(jade)
    .pipe(gulp.dest, yeoman.dist + "/");
    */

///////////
    // Tasks //
    ///////////

gulp.task('styles', function() {
    return gulp.src(paths.styles)
        .pipe(styles());
});

gulp.task('lint:scripts', function() {
    return gulp.src(paths.scripts)
        .pipe(lintScripts());
});

gulp.task('clean:tmp', function(cb) {
    rimraf(yeoman.temp, cb);
});

gulp.task('start:client', ['start:server', 'styles'], function() {
    openURL('http://localhost:9000');
});

gulp.task('start:server', function() {
    $.connect.server({
        root: [yeoman.temp, yeoman.app],
        livereload: true,
        port: 9000,
        middleware: function(connect, opt) {
            return [['/bower_components',
                connect["static"]('./bower_components')]]
        }
    });
});

gulp.task('start:server:test', function() {
    $.connect.server({
        root: [yeoman.test, yeoman.app, yeoman.temp],
        livereload: true,
        port: 9001,
        middleware: function(connect, opt) {
            return [['/bower_components', connect["static"]('./bower_components')]
            ]
        }
    });
});

gulp.task('watch', function() {
    $.watch(paths.styles)
        .pipe($.plumber())
        .pipe(styles())
        .pipe($.connect.reload());

    $.watch(paths.views.files)
        .pipe($.plumber())
        .pipe($.connect.reload());

    $.watch(paths.scripts)
        .pipe($.plumber())
        .pipe(lintScripts())
        .pipe($.connect.reload());

    $.watch(paths.test)
        .pipe($.plumber())
        .pipe(lintScripts());

    $.watch(paths.views.jade)
        .pipe($.plumber())
        .pipe(jade_tmp())
        .pipe($.connect.reload());

    gulp.watch('bower.json', ['bower']);
});

gulp.task('serve', function(cb) {
    runSequence('clean:tmp', 'jade',
        ['bower'],
        ['lint:scripts'],
        ['start:client'],
        'watch', cb);
});

gulp.task('serve:prod', function() {
    $.connect.server({
        root: [yeoman.dist],
        livereload: {
            port: 81
        },
        port: 80,
        middleware: function(connect, opt) {
            return [['/bower_components', connect["static"]('./bower_components')]
            ]
        }
    });
});

gulp.task('test', ['start:server:test'], function() {
    var testToFiles = paths.testRequire.concat(paths.scripts, paths.test);
    return gulp.src(testToFiles)
        .pipe($.karma({
            configFile: paths.karma,
            action: 'watch'
        }));
});


// inject bower components
gulp.task('bower', function() {
    return gulp.src(paths.views.main)
        .pipe(wiredep({
            directory: 'bower_components',
            ignorePath: '..'
        }))
        .pipe(gulp.dest(yeoman.temp));
});





///////////
// Build //
///////////

gulp.task('clean:dist', function(cb) {
    rimraf(yeoman.dist, cb);
});

gulp.task('client:build', ['html', 'styles', 'jade'], function() {

    var jsFilter = $.filter('**/*.js');
    var cssFilter = $.filter('**/*.css');

    return gulp.src(paths.views.bowermain)
        .pipe($.useref({
            searchPath: [yeoman.app, yeoman.temp]
        }))
        .pipe(jsFilter)
        .pipe($.ngAnnotate())
        .pipe($.uglify())
        .pipe(jsFilter.restore())
        .pipe(cssFilter)
        .pipe($.minifyCss({
            cache: true
        }))
        .pipe(cssFilter.restore())
        .pipe(gulp.dest(yeoman.dist));
});

gulp.task('html', function() {
    console.log('html is running!');
    return gulp.src(yeoman.app + '/views/**/*.html')
        .pipe(gulp.dest(yeoman.dist + '/views'));
});

gulp.task('jade', function() {
    gulp.src(yeoman.app + '/**/*.jade')
        .pipe(jade())
        .pipe(gulp.dest(yeoman.dist))
        .pipe(gulp.dest(yeoman.temp));

});

gulp.task('images', function() {
    return gulp.src(yeoman.app + '/images/**/*')
        /* .pipe($.cache($.imagemin({
             optimizationLevel: 5,
             progressive: true,
             interlaced: true
         })))*/
        .pipe(gulp.dest(yeoman.dist + '/images'));
});

gulp.task('copy:extras', function() {
    return gulp.src(yeoman.app + '/*/.*', {
        dot: true
    })
        .pipe(gulp.dest(yeoman.dist));
});

gulp.task('copy:fonts', function() {
    //return gulp.src(yeoman.app + '/fonts/**/*')
    //  .pipe(gulp.dest(yeoman.dist + '/fonts'));
    return gulp.src('./bower_components/bootstrap/dist/fonts/**/*')
        .pipe(gulp.dest(yeoman.dist + '/fonts'));
});
gulp.task('copy:favicon', function() {
    return gulp.src(yeoman.app + '/favicon.ico')
        .pipe(gulp.dest(yeoman.dist));
});
gulp.task('build', ['clean:dist', 'bower'], function() {
    runSequence(['images', 'copy:extras', 'copy:fonts', 'copy:favicon', 'client:build']);
});

gulp.task('default', ['build']);
