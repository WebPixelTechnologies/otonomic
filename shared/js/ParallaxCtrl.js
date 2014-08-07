angular.module('ng').filter('cut', function () {
    return function (value, wordwise, max, tail) {
        if (!value) return '';

        max = parseInt(max, 10);
        if (!max) return value;
        if (value.length <= max) return value;

        value = value.substr(0, max);
        if (wordwise) {
            var lastspace = value.lastIndexOf(' ');
            if (lastspace != -1) {
                value = value.substr(0, lastspace);
            }
        }

        return value + (tail || ' …');
    };
});

angular.module('Parallax', [ 'ngResource' ]);

function ParallaxCtrl($scope, $resource) {
    var site_id = getUrlVars()['site_id'];

    $scope.P2SData = $resource(
    	    'http://localhost/page2site/sites/debug_site/' + site_id,
    	    { },
    	    {get : { method:'GET', params: {format:'.json'} } }
    	);
    
    $scope.JSON_CALLBACK = function() {}

    $scope.getData = function() {
        $scope.P2SData.get({}, function(data) {
            $scope.site = data;
        });
    }

    /*
    $scope.site = {
        "name": "FC Barcelona",
        "title": "Our Page",
        "about": "Professional Sports Team",
        "description": "Welcome to the Official FC Barcelona Facebook Page www.fcbarcelona.com Mission Més que un Club The slogan \"More than a Club\" is open-ended in meaning. It is perhaps this flexibility that makes it so appropriate for defining the complexities of FC Barcelona’s identity, a Club that competes in a sporting sense on the field of play, but that also beats, every day, to the rhythm of its people’s concerns. Company Overview More than 100 years of history On November 29, 1899, Hans Gamper founded Futbol Club Barcelona, along with eleven other enthusiasts of football, a game that was still largely unknown in this part of the world. FC Barcelona has grown spectacularly in every area and has progressed into something much greater than a mere sports club, turning Barça’s ‘more than a club’ slogan into a reality.SECTIONS In Football the FC Barcelona has 15 Teams in some Divisions including Women´s teams. Refering other sections the FCB has another 4 Professional teams: Basketball, Handball, Roller Hockey and Indoor football.",
        "cover_photo": "https://fbcdn-sphotos-h-a.akamaihd.net/hphotos-ak-prn2/q71/s720x720/1521777_10152240775369305_492925880_n.jpg",
        "profile_photo": "https://fbcdn-sphotos-d-a.akamaihd.net/hphotos-ak-frc3/538939_10151023449664305_250020470_n.jpg",
        "address": "Yonge St. and Eglinton Ave, Toronto, Ontario, Canada",
        "location": "Camp Nou, Barcelona, Spain",
        "email": "test@me.com",
        "phone": "236-298-2828",
        "opening_hours": "Mon-Fri : 11:00am - 10:00pm Sat : 11:00am - 2:00pm Sun : 12:00am - 11:00pm",
        "facebook": "https://www.facebook.com/fcbarcelona",
        "twitter": "http://www.twitter.com/fcbarcelona",
        "pinterest": "http://www.pinterest.com/fcbarcelona",
        "linkedin_company_id":"3104980",

        "menu": [
            {
                "name": "Main",
                "slug": "main",
                "link": "#header"
            },
            {
                "name": "Services",
                "slug": "services",
                "link": "#services"
            },
            {
                "name": "Portfolio",
                "slug": "portfolio",
                "link": "#portfolio"
            },
            {
                "name": "Testimonials",
                "slug": "testimonials",
                "link": "#testimonials"
            },
            {
                "name": "News",
                "slug": "blog",
                "link": "#blog"
            },
            {
                "name": "Stay Updated",
                "slug": "social",
                "link": "#social"
            },
            {
                "name": "Contact",
                "slug": "contact",
                "link": "#contact"
            },
        ],
        "section": {
            "main_slider": {
                "hide":0,
                "items": [
                    {
                        "image_src": "https://fbcdn-sphotos-d-a.akamaihd.net/hphotos-ak-prn2/1461008_10152195218914305_325787904_n.png",
                        "title": "Club FCB",
                        "text": "Be a part of Barca's 114 year history"
                    },
                    {
                        "image_src": "https://fbcdn-sphotos-h-a.akamaihd.net/hphotos-ak-frc1/999277_10152220492514305_1161047182_n.png",
                        "title": "Team Spirit",
                        "text": "Feel like a Barca player"
                    },
                    {
                        "image_src": "https://fbcdn-sphotos-h-a.akamaihd.net/hphotos-ak-ash4/1457460_10152222818564305_1615012185_n.png",
                        "title": "Barca Heartbeats",
                        "text": "Barca Heartbeats..Be ready for a unique experience"
                    }
                ]
            },

            "testimonials": {
                "h1": "What people say",
                "h2": "",
                "limit": 4,
                "status": 1,
                "items": [
                    {
                        "name": "Miss Rachel",
                        "position": "Web Designer",
                        "text": "Very good design, Very good design, Very good design, Very good design, Very good design",
                        "image_src": "girl-face.jpg",
                        "link": ""
                    },
                    {
                        "name": "Miss Eva",
                        "position": "Graphic Artist",
                        "text": "Excellent graphics, Excellent graphics, Excellent graphics, Excellent graphics, Excellent graphics, ",
                        "image_src": "billionaire-boy-club-iceream-forumserver-twoplustwo-re-girls-with-perfect-faces-179799.jpg",
                        "link": ""
                    },
                    {
                        "name": "Mrs Liza",
                        "position": "Software Tester",
                        "text": "Well documented, Well documented, Well documented, Well documented, Well documented, ",
                        "image_src": "ashlee-simpson-pixels-tagged-faces-girls-173123.jpg",
                        "link": ""
                    },
                    {
                        "name": "Mrs Pryda",
                        "position": "Content Writer",
                        "text": "Vivid expressions, Vivid expressions, Vivid expressions, Vivid expressions, Vivid expressions, ",
                        "image_src": "beautiful-faces-cute-girls-hd-37170-hd-wallpapers-background.jpg",
                        "link": ""
                    }
                ]
            },

            "services": {
                "h1": "Services",
                "h2": "What we do",
                "limit": 4,
                "html": "We provide web design, development and custom mobile application development across a variety of technologies and platforms. We provide web design, development and custom mobile application development across a variety of technologies and platformsWe provide web design, development and custom mobile application development across a variety of technologies and platforms. We provide web design, development and custom mobile application development across a variety of technologies and platforms. We provide web design, development and custom mobile application development across a variety of technologies and platforms",
                "template": "templates/services.html"
            },

            "portfolio": {
                "h1": "Portfolio",
                "h2": "Recent Works",
                "limit": 8,
                "hide":0,
                "items": [
                    {
                        "id":"123",
                        "link": "/g",
                        "title": "PHP Frameworks",
                        "text": "Each PHP framework comes with a variety of features",
                        "date": "May 26, 1980",
                        "is_slider": 0,
                        "image_src": "http://www.appdynamics.com/blog/wp-content/uploads/2013/03/PHP-Logo.png",
                        "items": [
                            {
                                "link": "/g",
                                "title": "CakePHP",
                                "text": "First Blog Post",
                                "date": "May 26, 1980",
                                "image_src": "http://3.bp.blogspot.com/-NwXWcnkRMHI/T5pyNEqCmWI/AAAAAAAAAmE/Y8RshCdBpQw/s1600/%2BCakePHP-Framework.jpg",
                            },
                            {
                                "link": "/g",
                                "title": "Zend",
                                "text": "First Blog Post",
                                "date": "May 26, 1980",
                                "image_src": "http://framework.zend.com/images/logos/zf-logo-mark.png",
                            },
                            {
                                "link": "/g",
                                "title": "Yii",
                                "text": "First Blog Post",
                                "date": "May 26, 1980",
                                "image_src": "http://4.bp.blogspot.com/-kZS7vQmUrfk/UZdZ9qX3XPI/AAAAAAAAAE4/8sVdButREgw/s1600/yii3.jpg",
                            },
                            {
                                "link": "/g",
                                "title": "Yii",
                                "text": "First Blog Post",
                                "date": "May 26, 1980",
                                "image_src": "http://www.cetinakat.info/wp-content/uploads/2011/10/CodeIgniter_1680x10501.jpg",
                            }
                        ]
                    },
                    {
                        "id":"124",
                        "link": "/g",
                        "title": "CMS",
                        "text": "These are Content Management Systems",
                        "date": "March 26, 1980",
                        "image_src": "http://www.nextechinfoway.com/view/images/thumbs/php-cms.jpg",
                        "is_slider": 1,
                        "items": [
                            {
                                "link": "/g",
                                "title": "Drupal",
                                "text": "I love Drupal",
                                "date": "May 26, 1980",
                                "image_src": "http://www.mouserunner.com/images/DrupalSteel_1280x1024.png",
                            },
                            {
                                "link": "/g",
                                "title": "Google",
                                "text": "First Blog Post",
                                "date": "May 26, 1980",
                                "image_src": "http://gurutheme.com/blog/wp-content/themes/gurublog/images/default.jpg",
                            },
                            {
                                "link": "/g",
                                "title": "Google",
                                "text": "First Blog Post",
                                "date": "May 26, 1980",
                                "image_src": "http://www.amritray.com/wp-content/uploads/2011/08/88561567.jpg",
                            },
                        ]
                    },
                    {
                        "id":"125",
                        "link": "/g",
                        "title": "RDBMS",
                        "text": "Relational Database Managament Systems seem to be irreplaceable",
                        "date": "May 26, 1980",
                        "is_slider": 0,
                        "image_src": "https://www.udemy.com/blog/wp-content/uploads/2013/11/oraclevsmysqlvsoraclesql.jpg",
                        "items": [
                            {
                                "link": "/g",
                                "title": "MySQL",
                                "text": "First Blog Post",
                                "date": "May 26, 1980",
                                "image_src": "http://rjhcc.dyndns.biz/media/mysql.png",
                            },
                            {
                                "link": "/g",
                                "title": "MS SQL Server",
                                "text": "First Blog Post",
                                "date": "May 26, 1980",
                                "image_src": "http://www.awoessner.com/images/1000/1000_SQLServerLogo.jpg",
                            },
                            {
                                "link": "/g",
                                "title": "Oracle",
                                "text": "First Blog Post",
                                "date": "May 26, 1980",
                                "image_src": "http://download.zdenkovrabel.org/tmp/oracle.jpg",
                            },
                            {
                                "link": "/g",
                                "title": "Yii",
                                "text": "First Blog Post",
                                "date": "May 26, 1980",
                                "image_src": "http://www.cetinakat.info/wp-content/uploads/2011/10/CodeIgniter_1680x10501.jpg",
                            },
                        ]
                    },
                    {
                        "id":"126",
                        "link": "/g",
                        "title": "JavaScript Frameworks",
                        "text": "Nowadays there are many MVC JavaScript frameworks to make the job easy",
                        "date": "March 26, 1980",
                        "image_src": "http://www.w3resource.com/javascript/javascript-logo.png",
                        "is_slider": 1,
                        "items": [
                            {
                                "link": "/g",
                                "title": "Drupal",
                                "text": "I love Drupal",
                                "date": "May 26, 1980",
                                "image_src": "http://creativeproject.files.wordpress.com/2012/11/angularjs.jpg?w=540",
                            },
                            {
                                "link": "/g",
                                "title": "Google",
                                "text": "First Blog Post",
                                "date": "May 26, 1980",
                                "image_src": "http://creativeproject.files.wordpress.com/2012/11/backbone.jpg?w=540",
                            },
                            {
                                "link": "/g",
                                "title": "Google",
                                "text": "First Blog Post",
                                "date": "May 26, 1980",
                                "image_src": "http://images8.alphacoders.com/380/380534.png",
                            }
                        ]
                    }
                ]
            },

            "social": {
                "h1": "Stay Updated",
                "h2": "Follow us on Facebook, Twitter, and Instagram",
                "hide":0
            },

            "contact": {
                "h1": "Keep in Touch",
                "h2": "Drop by and say hi...",
                "hide":0
            },

            "blog": {
                "h1": "News",
                "h2": "Recent Posts",
                "hide":0,
                "limit": 3,
                "posts": [
                    {
                        "link": "/g",
                        "title": "Client Testimonial",
                        "text": "It does not matter how slowly you go as long as you do not stop.",
                        "date": "Dec 26, 2010",
                        "author": "Mr Abcde",
                        "image_src": "",
                        "type": "testimonial"
                    },
                    {
                        "link": "/g",
                        "title": "My Status",
                        "text": "First Blog Post, First Blog Post, First Blog Post, First Blog Post, First Blog Post, ",
                        "date": "June 11, 2011",
                        "author": "Mr Author",
                        "image_src": "http://images2.layoutsparks.com/1/161114/beautiful-beach-nature-scenery.jpg",
                        "type": "status"
                    },

                    {
                        "link": "/g",
                        "title": "A beautiful scenery",
                        "text": "2nd Blog Post, 2nd Blog Post, 2nd Blog Post, 2nd Blog Post, 2nd Blog Post, ",
                        "date": "March 26, 1980",
                        "author": "Miss Author",
                        "image_src": "http://www.hdwallpapersarena.com/wp-content/uploads/2013/05/Scenery-Wallpaper.jpg",
                        "type": "image"
                    },
                    {
                        "link": "/g",
                        "title": "Client Testimonial",
                        "text": "They have done a good job..saving me a lot of time and money",
                        "date": "Dec 26, 2013",
                        "author": "Albert Middleton",
                        "image_src": "",
                        "type": "testimonial"
                    },
                    {
                        "link": "/g",
                        "title": "Ferrari Scaglietti",
                        "text": "The car has an awesome appeal",
                        "date": "Feb 16, 2005",
                        "author": "Tom Boy",
                        "image_src": "http://www.hdwallpaperstop.com/wp-content/uploads/2013/04/Car-Ferrari-HD-Wallpaper.jpg",
                        "type": "image"
                    },
                ]
            },

            "team": {
                "h1": "Meet the Team",
                "h2": "Happy to Serve You!",
                "hide":1,
                "limit": 4,
                "members": [
                    {
                        "name": "Mr Someone",
                        "position": "CEO",
                        "image_src": "wp-content/themes/agency/themify/imgf3cf.php?src=http://themify.me/demo/themes/agency/files/2012/11/1059427101.jpg&amp;w=&amp;h=&amp;zc=1",
                    }    ,
                    {
                        "name": "Mr Sometwo",
                        "position": "VP",
                        "image_src": "wp-content/themes/agency/themify/imgf3cf.php?src=http://themify.me/demo/themes/agency/files/2012/11/1059427101.jpg&amp;w=&amp;h=&amp;zc=1",
                    },
                    {
                        "name": "Mr Somethree",
                        "position": "Manager",
                        "image_src": "wp-content/themes/agency/themify/imgf3cf.php?src=http://themify.me/demo/themes/agency/files/2012/11/1059427101.jpg&amp;w=&amp;h=&amp;zc=1",
                    }    ,
                    {
                        "name": "Mr Somefour",
                        "position": "Finance",
                        "image_src": "wp-content/themes/agency/themify/imgf3cf.php?src=http://themify.me/demo/themes/agency/files/2012/11/1059427101.jpg&amp;w=&amp;h=&amp;zc=1",
                    }
                ]
            }
        }
    };
*/

    $scope.templates =
        [
            {
                "name": "Parallax",
                "rootpath": "../parallax",
                "includes": {
                    "header": {"name": "header", "url": "../parallax/header.html"},
                    "footer": {"name": "header", "url": "../parallax/footer.html"}
                }
            },
            {
                "name": "Agency",
                "rootpath": "../agency",
                "includes": {
                    "header": {"name": "header", "url": "../agency/header.html"},
                    "footer": {"name": "header", "url": "../agency/footer.html"}
                }
            },
            {
                "name": "Metro",
                "rootpath": "../metro",
                "includes": {
                    "header": {"name": "header", "url": "../metro/header.html"},
                    "footer": {"name": "header", "url": "../metro/footer.html"}
                }
            },
            {
                "name": "Blogfolio",
                "rootpath": "../blogfolio",
                "includes": {
                    "header": {"name": "header", "url": "../blogfolio/header.html"},
                    "footer": {"name": "header", "url": "../blogfolio/footer.html"}
                }
            }
        ];

    $scope.agency=$scope.templates[0];
	$scope.metro=$scope.templates[1];
	$scope.blogfolio=$scope.templates[2];

    //$scope.getData();
};
