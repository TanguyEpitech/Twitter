<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<style>
.user_date {
    font-size: 10px;
}


#photo_auth_user {
    transform: translateY(-18px);
}



.body {
    text-align: left;

    margin: 15px;
    padding: 4px;
}

.comment_tweet {
    color: #1da1f2;

    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    border-top: 1px solid #c3babab3;

}

.text-area {
    color: #1da1f2;

    border: none;
    margin: 5px;
    background: white;
    border-radius: 20px;
    box-shadow: 1px 1px 16px #1818d191;

}

.actu-js {
    margin: 55px;
    text-align: center;

}

.user_info {
    margin-left: -45px;
}

.img_profil_photo {
    height: 50px;
    width: 50px;
    border-radius: 100%;

    margin-right: -15px;

}

.add-tweet {

    width: 150px;
    border: none;
    margin-top: -15px;
    /* margin: 5px; */
    margin-bottom: 25px;
    padding: 20px;
    background: white;
    border-radius: 20px;
    box-shadow: 1px 1px 16px #1818d191;
    padding: 13px 15px;
    color: #1da1f2;
}

.add-tweet:active {

    box-shadow: 1px 1px 16px inset #1818d191;
}

#text-area {
    width: 150px;
    border: none;
    margin-top: -15px;
    /* margin: 5px; */
    margin-bottom: 25px;
    padding: 20px;
    background: white;
    border-radius: 20px;
    box-shadow: 1px 1px 16px #1818d191;
    padding: 13px 15px;
    color: #1da1f2; 
}


.tweet {

    margin: 5px;
    margin-bottom: 25px;
    padding: 20px;
    background: white;
    border-radius: 20px;
    box-shadow: 1px 1px 16px #1818d191;

}

.img_profil {
    display: grid;
    grid-template-columns: 1fr 1fr 1fr;
    justify-content: center;
    align-content: center;
    align-items: center;
}

.content {
    height: 100%;
    background: #1DA1F2;
}

.btn_comment {
    margin-right: 72px;
    margin-top: 20px;
    text-align: right;
    }

.comment {
    max-width: 200px;
    grid-template-columns: repeat(2, 93px 1fr) 123px;
    grid-template-columns: repeat(2, 93px 1fr) 87px;
 
    padding-top: 100px;

    align-content: center;
    justify-content: space-around;
    align-items: end;
    display: grid;
    gap: 20px;
    justify-items: stretch;
}

</style>




<div class="content">

    <div class="card">
        <div class="comment" style="margin: auto;text-align: center;">

            <div class="auth_user"></div>
            <input id="text-area" type="text" placeholder="votre tweet" name="">
            <div class="btn_comment">
            <button class="btn btn-primary add-tweet">Tweet</button>
        </div>
        </div>
  
    </div>

    
    <div id="message">





    </div>

    <div class="actu-js">




    </div>

</div>


<script type="text/javascript">
var actu = $(".actu-js");







function auth_user() {
    $.ajax({
        type: "POST",
        url: "../../backend/controller/connected_user.php",
        success: function(user_auth) {
            if (user_auth != "") {

                $(".auth_user").append("<img class='img_profil_photo' id='photo_auth_user' src='../backend/userpp/" + user_auth +
                    ".png'>");
                console.log(user_auth)


            } else {

                console.log("Un pb est survenu")
            }
        }
    });

}
















window.onload = function() {

    auth_user()
    $.ajax({
        type: "POST",
        url: "../../backend/controller/fil_actu_controller.php",
        success: function(resultat) {
            if (resultat != "") {


                var data = JSON.parse(resultat);

                console.log(data) // data[0].text_post

                for (let i = 0; i < data.length; i++) {


                    actu.append("<div class='tweet " + i + "' ></div>");

                    $("." + i).append("<div class='img_profil select_" + i +
                        "   '> <img class='img_profil_photo' src='../backend/userpp/" + data[i]
                        .pseudo + ".png'></div>");

                    $(".select_" + i).append("<div class='user_info' >" + data[i].pseudo + "</div>")
                    $(".select_" + i).append("<div class='user_date' >" + data[i].date_post + "</div>")

                    $("." + i).append("<div class='body' >" + data[i].text_post + "</div>");

                    $("." + i).append(
                        "<div class='comment_tweet' > <p class='btn retweet' onclick='comment()'> <ion-icon name='heart-outline'></ion-icon>  <p class='btn retweet'> <ion-icon name='code-outline'></ion-icon>  </p>  <p class='btn retweet'> <ion-icon name='share-outline'></ion-icon>  </p></div>"
                        );

                }


            } else {

                console.log("aucun tweet")
            }
        }
    });

}


function comment(e) {
    console.log("click");

$("")


}

var addtweet = $(".add-tweet");
$(addtweet).click(function(e) {
    var message = $("#message")
    var text_area = $("#text-area").val();

console.log(text_area)
    e.preventDefault();

    if (text_area == "") {

    } else {



        $.ajax({
            type: "POST",
            url: "../../backend/controller/post_tweet_controller.php",
            data: {
                comment: text_area,
            },
            success: function(resultat, statut) {
                if (resultat != "success") {
                    $(message).addClass("alert alert-danger");

                    location.reload(true);



                } else {

                }
            }
        });
    }

});
</script>