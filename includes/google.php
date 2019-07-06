 <!-- Google Sign In -->
<script src="https://apis.google.com/js/platform.js" async defer></script>
 <!-- Google Client Id -->
<meta name="google-signin-client_id" content="1039303329820-r15n3v6hhg3242kkn733oon7r0qveujs.apps.googleusercontent.com">
<script>
    $(function(){ onLoad(); });
    var auth2;
    function onLoad(){
        gapi.load('auth2', function() {
            auth2=gapi.auth2.init({
                client_id: '1039303329820-r15n3v6hhg3242kkn733oon7r0qveujs.apps.googleusercontent.com',
                fetch_basic_profile: false,
                scope: 'email',
            });
        });
    }
    function onSignIn(googleUser){
        var profile=googleUser.getBasicProfile();
        // console.log('ID: ' + profile.getId());
        // console.log('Full Name: ' + profile.getName());
        // console.log('Given Name: ' + profile.getGivenName());
        // console.log('Family Name: ' + profile.getFamilyName());
        // console.log('Image URL: ' + profile.getImageUrl());
        // console.log('Email: ' + profile.getEmail());
        $.ajax({
            url: "scripts/connection.php?logScript.php",
            type: "POST",
            data: profile,
            success: function(response){
                if(response == "Email 404"){
                    $.ajax({
                        url: "scripts/connection.php?logScript.php",
                        type: "POST",
                        data: {
                            U3: profile.getEmail(),
                        },
                    });
                }
                window.location.reload();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status +" "+ thrownError+"\nReload the page and try again!");
                window.location.reload();
            }
        });
    }
  function signOut() {
    var auth2=gapi.auth2.getAuthInstance();
    auth2.signOut().then(function () {
        var auth2=gapi.auth2.getAuthInstance();
        auth2.signOut();
        auth2.disconnect();
        $.ajax({
            url: "scripts/connection.php?logScript.php",
            type: "POST",
            success: function(response){
                window.location.reload();
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    });
  }
</script>
