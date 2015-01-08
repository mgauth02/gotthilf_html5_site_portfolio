module.exports = function(grunt) {

  // Project configuration.
  grunt.initConfig({

    less : {
      dev : {
        files : {
          ".tmp/main.css": "app/styles/main.less"
        }
      }
    },
    autoprefixer : {
      dev : {
        files : {
          ".tmp/main.css": ".tmp/main.css"
        }
      }
    },
    cssmin: {
      target: {
        files: [{
          expand: true,
          cwd: '.tmp/',
          src: ['*.css', '!*.min.css'],
          dest: 'app/styles/',
          ext: '.min.css'
        }]
      }
    },
    connect : {
      server : {
        options : {
          base : ['app','.tmp'],
          port : 8000
        }
      }
    },
    // php : {
    //   options : {
    //     bin : "php-5.4.36/php.ini-development"
    //   },
      watch : {
        less : {
          files : ['app/styles/*.less'],
          tasks : ['css']
        }
      }
    // }
  });

  // Load the plugin that provides the "uglify" task.
  grunt.loadNpmTasks('grunt-contrib-less');
  grunt.loadNpmTasks('grunt-autoprefixer');
  grunt.loadNpmTasks('grunt-contrib-cssmin');
  grunt.loadNpmTasks('grunt-contrib-connect');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-clean');
  // grunt.loadNpmTasks('grunt-php');

  // Default task(s).
  grunt.registerTask('default', ['server']);

  grunt.registerTask('css', ['less', 'autoprefixer', 'cssmin']);
  grunt.registerTask('server', ['css', 'connect', 'watch']); //php:watch

};