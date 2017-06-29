var gulp = require('gulp');
var sass = require('gulp-sass');
var sourcemaps = require('gulp-sourcemaps');
var autoprefixer = require('gulp-autoprefixer');
var browserSync = require('browser-sync').create();

var input = './assets/scss/**/*.scss';
var output = './assets/css';

var sassOptions = {
	errLogToConsole: true,
	outputStyle: 'expanded'
};

gulp.task('browser-sync', function() {

});

gulp.task('sass', function () {
	return gulp
		.src(input)
		.pipe(sourcemaps.init())
			.pipe(sass(sassOptions).on('error', sass.logError))
			.pipe(autoprefixer())
		.pipe(sourcemaps.write())
		.pipe(gulp.dest(output))
		.pipe(browserSync.stream());
});

gulp.task('watch', function() {
	browserSync.init({
		proxy: {
			target: "localhost:8888",
			ws: true
		},
		port: 8888
	});

	return gulp
		.watch(input, ['sass'])
		.on('change', function(event) {
			browserSync.reload();
			console.log('File ' + event.path + ' was ' + event.type + ', running tasks...');
		});
});

gulp.task('default', ['sass', 'watch']);
