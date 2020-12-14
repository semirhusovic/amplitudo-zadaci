$(document).ready(() => {
    const apiKey = 'fdb9ea3c'
    $('.output').hide();
    $('.pretraga').on('click', () => {
        let naslov = $('#kriterijum')
        let tip = $('#tip')
        let godina = $('#godina')
        $.ajax({  
            url: `http://www.omdbapi.com/?apikey=${apiKey}&t=${naslov.val()}&type=${tip.val()}&y=${godina.val()}`,  
            dataType: 'text',  
            type: "GET",  
            success: function(data) {  
            let podaciJSON = JSON.parse(data);
            $('.output').show();
            $(".oNaziv").html(podaciJSON.Title);
            $(".oGodina").html(podaciJSON.Year);
            $(".oDatum").html(podaciJSON.Released);
            $(".oTrajanje").html(podaciJSON.Runtime);
            $(".posterImg").attr("src",podaciJSON.Poster);
            $(".oReziser").html(podaciJSON.Director);
            $(".oGlumci").html(podaciJSON.Actors);
            $(".oRadnja").html(podaciJSON.Plot);
            $(".oBrSez").html(podaciJSON.totalSeasons);
            $(".label").html(podaciJSON.Type);

           if(tip.val() == 'series') {
            $('.brSez').show();
           }
           else {
            $('.brSez').hide();   
           }
        $(".oRadnja").html(podaciJSON.Plot);
        podaciJSON.Ratings.forEach((el) => {
            $( ".oRejting" ).append(`<br> ${el.Source} : ${el.Value}`);
        })
            }  
            });  


    })
})
