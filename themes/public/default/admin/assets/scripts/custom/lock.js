var Lock = function () {

    return {
        //main function to initiate the module
        init: function () {

             $.backstretch([
		        "/web/admin/assets/img/bg/1.jpg",
		        "/web/admin/assets/img/bg/1_2.jpg",
                "/web/admin/assets/img/bg/2.jpg",
		        "/web/admin/assets/img/bg/2_2.jpg",
                "/web/admin/assets/img/bg/3.jpg",
                "/web/admin/assets/img/bg/3_2.jpg",
		        "/web/admin/assets/img/bg/4.jpg",
                "/web/admin/assets/img/bg/4_2.jpg",

		        ], {
		          fade: 1000,
		          duration: 8000
		      });
        }

    };

}();