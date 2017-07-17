var gulp = require('gulp');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var autoprefixer = require('gulp-autoprefixer');
var browserSync = require('browser-sync').create();

var input = './web/assets/scss/**/*.scss';
var output = './web/assets/css';

var sassOptions = {
	errLogToConsole: true,
	outputStyle: 'expanded'
};

gulp.task('browser-sync', function() {
	browserSync.init({
		proxy: {
			target: "localhost:8888",
			ws: true
		},
		port: 8888
	});
});

gulp.task('sass', function () {
	return gulp
		.src(input)
		.pipe(sourcemaps.init())
			.pipe(sass(sassOptions).on('error', sass.logError))
			.pipe(autoprefixer())
		.pipe(sourcemaps.write())
		.pipe(gulp.dest(output))
		.pipe(browserSync.reload({
			stream: true
		}))
		.pipe(function() {
			console.log('File ' + event.path + ' was ' + event.type + ', running tasks...');
		});
});

gulp.task('watch', ['browser-sync'], function() {
	gulp.watch(input, ['sass']);
	gulp.watch('./app/**/*.php', browserSync.reload);
});

gulp.task('default', ['watch']);
