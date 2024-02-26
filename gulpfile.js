// Load plugins
const browsersync = require('browser-sync').create();
const gulp = require('gulp');
const sass = require('gulp-sass')(require('sass'));
const rename = require('gulp-rename');
const postcss = require('gulp-postcss');
const autoprefixer = require('autoprefixer');
const cssnano = require('cssnano');
const concat = require('gulp-concat');
const jshint = require('gulp-jshint');
const uglify = require('gulp-uglify');
var sourcemaps = require('gulp-sourcemaps');

// BrowserSync
function browserSync(done) {
	browsersync.init({
		proxy: {
			target: 'http://localhost/baketivity',
		},

	});
	done();
}

// BrowserSync Reload
function browserSyncStream(done) {
	done();
}
// BrowserSync Reload
function browserSyncReload(done) {
	browsersync.reload();
	done();
}

// CSS task
function css() {
	return gulp
		.src("./sass/**/*.scss")
		.pipe(sourcemaps.init())
		.pipe(sass({ outputStyle: "expanded" }).on("error", sass.logError))
		.pipe(postcss([cssnano()])) // Apply CSS minification
		.pipe(browsersync.stream())
		.pipe(sourcemaps.write("."))
		.pipe(gulp.dest("./"));
}

// JavaScript task
function js() {
	return gulp.src(['./js/*.js', '!./js/app.min.js'])
		.pipe(sourcemaps.init())
		.pipe(jshint({ esnext: true }))
		.pipe(jshint.reporter('default'))
		.pipe(concat('app.js'))
		.pipe(rename({ suffix: '.min' }))
		.pipe(uglify())
		.pipe(sourcemaps.write('.'))
		.pipe(gulp.dest('./js'));
}

// Watch files
function watchFiles() {
	gulp.watch('./sass/**/*.scss', gulp.series(css, browserSyncStream));
	gulp.watch(['./js/*.js', '!./js/app.min.js'], gulp.series(js, browserSyncReload));
}

// define complex tasks
const watch = gulp.parallel(watchFiles, browserSync);
const build = gulp.series(css, watch);
const buildAssets = gulp.series(css, js);

// export tasks
exports.css = css;
exports.watch = watch;
exports.default = build;
exports.buildAssets = buildAssets;