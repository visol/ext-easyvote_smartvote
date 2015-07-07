module.exports = function(grunt) {
	'use strict';

	grunt.loadNpmTasks('grunt-babel');
	grunt.loadNpmTasks('grunt-browserify');
	grunt.loadNpmTasks('grunt-contrib-watch');
	grunt.loadNpmTasks('grunt-contrib-uglify');

	grunt.initConfig({

		pkg: grunt.file.readJSON("package.json"),

		babel: {
			options: {
				optional: ['runtime'],
				experimental: true
			},
			dist: {
				files: [{
					expand: true,
					cwd: 'Resources/Public/JavaScript/App',
					src: ['**/*.js'],
					dest: 'Resources/Public/JavaScript/Build'
				}]
			}
		},

		browserify: {
			dist: {
				files: {
					'Resources/Public/JavaScript/Build/QuestionBundle.js': 'Resources/Public/JavaScript/Build/QuestionApplication.js',
					'Resources/Public/JavaScript/Build/CandidateBundle.js': 'Resources/Public/JavaScript/Build/CandidateApplication.js'
				}
			}
		},

		watch: {
			js: {
				files: ["Resources/Public/JavaScript/App/**/**/*.js"],
				tasks: ["default"]
			}
		},

		uglify: {
			options: {
				banner: "/*! <%= pkg.name %> <%= grunt.template.today(\"dd-mm-yyyy\") %> */\n\n"
			},
			dist: {
				files: {
					'Resources/Public/JavaScript/Build/QuestionBundle.min.js': 'Resources/Public/JavaScript/Build/QuestionBundle.js',
					'Resources/Public/JavaScript/Build/CandidateBundle.min.js': 'Resources/Public/JavaScript/Build/CandidateBundle.js'
				}
			}
		}
	});

	grunt.registerTask('default', ['babel', 'browserify', 'uglify']);

};
