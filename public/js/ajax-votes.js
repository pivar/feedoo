$(document).ready(function(){
   // api url to be called for voting up
    var url = "/api/addVotesUp";
    $('#votes-up a').click(function(){
        // taking the link as ID for storing and mapping votes
        var feed_id =$(this).attr("id");
        // using substring for custom logic to fetch/link feed titles
        // while storing in xml for voting purposes
        $.ajax({
            type: "POST",
            data: {'feed_id':feed_id.substring(3)},
            url: url,
            success: function (data) {
                // console.log(data);
                // append DOM specific span for updation
                feed_id = '#'+feed_id +' span';
                $(feed_id).text(data);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

    $('#votes-down a').click(function(){
        var url = "/api/addVotesDown";
        // taking the link as ID for storing and mapping votes
        var feed_id =$(this).attr("id");
        $.ajax({
            type: "POST",
            data: {'feed_id':feed_id.substring(5)},
            url: url,
            success: function (data) {
                // console.log(data);
                feed_id = '#'+feed_id +' span';
                $(feed_id).text(data);
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });


});
