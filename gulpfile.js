/* File: gulpfile.js */

var gulp = require('gulp'),
	jshint = require('gulp-jshint'),
	sass = require('gulp-sass'),
	sourcemaps = require('gulp-sourcemaps'),
	concat = require('gulp-concat-multi'),
	uglify = require('gulp-uglify');

// define the default task and add the watch task to it
gulp.task('default', ['watch']);

gulp.task('build-sass', function() {
	return gulp.src('webroot/css/sass/*.scss')
		.pipe(sourcemaps.init())
			.pipe(sass())
		.pipe(sourcemaps.write())
		.pipe(gulp.dest('webroot/css/'));
});

gulp.task('build-css', function(){
	return gulp.src('webroot/css/source/*.css')
		.pipe(cleanCSS({compatibility: 'ie8'}))
		.pipe(gulp.dest('dist'));
});

gulp.task('build-js', function() {
	return gulp.src('webroot/js/src/*.js')
		.pipe(sourcemaps.init())
			.pipe(concat({
				'user-list.min.js': 'webroot/js/src/user-list.js',
				}))
			.pipe(uglify())
		.pipe(sourcemaps.write())
		.pipe(gulp.dest('webroot/js/'));

	// return gulp.src(['webroot/js/user_scripts/login-script.js', 'webroot/js/user_scripts/registration-script.js'])
	// 	.pipe(sourcemaps.init())
	// 		.pipe(concat({
	// 			'login.min.js': 'webroot/js/user_scripts/login-script.js',
	// 			'registration.min.js': 'webroot/js/user_scripts/registration-script.js'
	// 			}))
	// 		.pipe(uglify())
	// 	.pipe(sourcemaps.write())
	// 	.pipe(gulp.dest('webroot/js/'));
});

// configure the jshint task
gulp.task('jshint', function() {
	return gulp.src('webroot/js/*')
		.pipe(jshint())
		.pipe(jshint.reporter('jshint-stylish'));
});

gulp.task('watch', function()
{
	gulp.watch('webroot/js/**/*.js', ['jshint']);
	gulp.watch('webroot/css/sass/*.scss', ['build-sass']);
	gulp.watch('webroot/css/source/*.scss', ['build-css']);
	gulp.watch('webroot/js/**/*.js', ['build-js']);
});