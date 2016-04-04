module.exports = function(grunt) {

	grunt.initConfig({

		pkg: grunt.file.readJSON('package.json'),

        // Arbitrary properties used in task configuration templates.
        src_dir_sass: 'src/sass',
        src_dir_js: 'src/js',
        dest_dir_css: 'assets/css',
        dest_dir_js: 'assets/js',
        dest_dir_vendor: 'assets/vendor',

        sass: {
			dist: {
				options: {
					style: 'compressed',
					sourcemap: 'none',
                    unixNewlines: true
				},
				files: {
					'<%= dest_dir_css %>/parent.css': '<%= src_dir_sass %>/parent.scss'
				}
			}
		},
		copy: {
			dist: {
				files: [{
					expand: true,
					dot: true,
					cwd: '<%= dest_dir_vendor %>/font-awesome',
					src: ['fonts/*.*'],
					dest: 'assets'
				}]
			}
		},
        concat: {
            options: {
                /*stripBanners: true*/
                stripBanners: {
                    block: true,
                    line: true
                }
            },
            js_dist: {
                src: [
                    '<%= src_dir_js %>/*.js', // all files in alpha order
                    '!<%= src_dir_js %>/init.js', // except for init.js
                    '<%= src_dir_js %>/init.js' // which we add in the end
                ],
                dest: '<%= dest_dir_js %>/concat.js'
            }
        },
        uglify: {
            options: {
                preserveComments: false
            },
            js_dist: {
                src: '<%= dest_dir_js %>/concat.js',
                dest: '<%= dest_dir_js %>/concat.min.js'
            }
        },
		cssmin: {
			target: {
				files: [{
					expand: true,
					cwd: '<%= dest_dir_css %>',
					src: ['*.css', '!*.min.css'],
					dest: '<%= dest_dir_css %>',
					ext: '.min.css'
				}]
			}
		},
		clean: {
			css: [
				'<%= dest_dir_css %>/parent.css'
			],
            js: [
                '<%= dest_dir_js %>/concat.js'
            ]
		}
	});

	require('load-grunt-tasks')(grunt);

	grunt.registerTask('default', ['sass', 'copy', 'concat', 'uglify', 'cssmin', 'clean']);

};