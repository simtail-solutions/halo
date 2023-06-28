let sass = require('sass')
let package = require('./package.json')

module.exports = function (grunt) {
	grunt.initConfig({
		pkg: grunt.file.readJSON('package.json'),
		
		'dart-sass': {
			portal: {
				options: {
					sourceMap: true
				},
				files: {
					'./public/css/app.css': './resources/scss/app.scss'
				}
			}
		},

		watch: {
			portal: {
				files: [
					'./resources/scss/**/*',
					'./resources/views/**/*'

				],
				tasks: ['dart-sass:portal'],
				options: { spawn: true }
			},
		},

		browserSync: {
			dev: {
				bsFiles: {
					src : [
						'./public/css/app.css',
						'./**/*.php'
					]
				},
				options: {
					watchTask: true,
					proxy: {
						target: "http://localhost:7070",
					}
				}
			}
		}
	})

	grunt.loadNpmTasks('grunt-contrib-watch')
	grunt.loadNpmTasks('grunt-dart-sass')
	grunt.loadNpmTasks('grunt-browser-sync')

	grunt.registerTask('default', ['browserSync', 'watch'])
}