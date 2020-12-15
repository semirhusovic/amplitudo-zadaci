$(document).ready(() => {
    const apiKey = 'fdb9ea3c'
        $( "form" ).click(function( event ) {
            event.preventDefault()});
    $('.output').hide();
    $('.pretraga').on('click', () => {
        let naslov = $('#kriterijum')
        let tip = $('#tip')
        let godina = $('#godina')
        if (naslov.val().length == 0) {
            alert('Naziv mora biti popunjen')
        }
        $.ajax({  
            url: `http://www.omdbapi.com/?apikey=${apiKey}&t=${naslov.val()}&type=${tip.val()}&y=${godina.val()}`,  
            dataType: 'text',  
            type: "GET",  
            success: function(data) {  
            $('.info').html(''); // brisanje starih podataka iz tabele
            $('.errors').html(''); // brisanje starih gresaka iz tabele
            let podaciJSON = JSON.parse(data);
            if(podaciJSON.Error != undefined) {
                $('.output').hide();
                $(".errors").html(`${podaciJSON.Error}`)  
            }
            $(".posterImg").attr("src",podaciJSON.Poster);
            $(".info").append(`<table class="table table-dark">
            <tbody id="InfoData">
            <tr>
                <td><b>Naziv</b></td>
                <td colspan="2">${podaciJSON.Title}</td>
            </tr>
            <tr>
                <td><b>Godina</b></td>
                <td colspan="2">${podaciJSON.Year}</td>
            </tr>
            <tr>
                <td><b>Datum</b></td>
                <td colspan="2">${podaciJSON.Released}</td>
            </tr>
            <tr>
                <td><b>Trajanje</b></td>
                <td colspan="2">${podaciJSON.Runtime}</td>
            </tr>
            <tr>
                <td><b>Reziser</b></td>
                <td colspan="2">${podaciJSON.Director}</td>
            </tr>
            <tr>
                <td><b>Glumci</b></td>
                <td colspan="2">${podaciJSON.Actors}</td>
            </tr>
            <tr>
                <td><b>Radnja</b></td>
                <td colspan="2">${podaciJSON.Plot}</td>
            </tr>
            <tr>
                <td><b>Rejting</b></td>
                <td></td>
                <td></td>
            </tr>
            </tbody>
            </table>
            `)
        podaciJSON.Ratings.forEach((el) => {
            $( "#InfoData" ).append(`<tr>
            <td></td>
            <td>${el.Source}</td>
            <td>${el.Value}</td>
            </tr>`
            );
        })
        if(tip.val() == 'series') {
            $( "#InfoData" ).append(`<tr>
            <td><b>Broj Sezona</b></td>
            <td>${podaciJSON.totalSeasons}</td>
            <td></td>
            </tr>`)
        }
    
            $('.output').show();
            }, 

            error: function(xhr, status, error){
                var errorMessage = xhr.status + ': ' + xhr.statusText
                $(".errors").html(`${errorMessage}`)
            }

        });  

    })
})
