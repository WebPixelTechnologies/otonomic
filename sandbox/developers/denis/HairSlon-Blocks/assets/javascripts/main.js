$(function(){

    // Starting animation: Slide faces up
    /////////////////////////////////////
    function slideFacesUp($element){

        $element.velocity(
            "transition.bounceUpIn", 
            { 
                stagger: 250,
                display: "inline-block",
                backwards: true
            }, 500
        )
    }

    // Starting animation: Slide current face in
    /////////////////////////////////////
    function slideCurrentFaceIn($element){

        var arc_params = {
            center: [455,15],  
                radius: 256,    
                start: -90,
                end: -133,
                dir: -1
        }
          
        $element.animate({
            path : new $.path.arc(arc_params),
            opacity: 1
        }, 300,"linear")
    }

    // Bubble + Content animation in
    ////////////////////////////////////

    var $element_1 = $('.main-bubble');
    var $element_2 = $('.main-bubble-content .name, .main-bubble-content .social-content, .main-bubble-content .text, .main-bubble-content .social-content-2');
    var $element_3 = $('.socializer-controls > a');

    var bubbleContentSequence = [
        { e: $element_1, p: 'transition.slideRightIn', 
            o: { 
                duration: 500,
                sequenceQueue: false,
                easing: 'easeOutBack', 
                complete: function() { 

                    // Faces in animation
                    slideFacesUp ($('.face-bubble').not('.current'));
                    slideCurrentFaceIn ($('.face-bubble.current')); 
                }   
            }
        },
        { e: $element_2, p: 'transition.slideRightIn' , o: { duration: 500, sequenceQueue: false, } },
        { e: $element_3, p: 'transition.fadeIn' , o: { duration: 500, sequenceQueue: false, } }
    ];

    $.Velocity.RunSequence(bubbleContentSequence);
});