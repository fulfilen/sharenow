
let URI = "/ajax/api.php";


function validateEmail(emailAdress){
    $.ajax({
        url: URI,
        method: "POST",
        data: { 
            emailAdress: emailAdress,
            validateEmail: 1
        },
        dataType: "text",
        success: function(response){
            $('#email').html(response);
        }
    });
}

function loadCategories(forumId){
    $.ajax({
        url: URI,
        method: "POST",
        data: { 
            forumId: forumId 
        },
        dataType: "text",
        success: (response) => {
            $('#category').html(response);
        }
    });
}

function loadForumComments(limit, cid){
    $.ajax({
        url: URI,
        method: "POST",
        data: { 
            limit: limit,
            cid: cid
        },
        beforeSend: function() {
            $('#pagination').append("<i class='fa fa-circle-o-notch fa-spin fa-3x fa-fw'></i>");
        },
        complete: function() {
            $('.fa').remove();
        },
        success: function(response) {
            console.log(response);
            $('#comment-listing').html(response);
        }
    }); 
}

function animatethis(targetElement, speed) {
    var width = $(targetElement).width();
    $(targetElement).animate({ marginLeft: "-="+width},
    {
        duration: speed,
        complete: function ()
        {
            targetElement.animate({ marginLeft: "+="+width },
            {
                duration: speed,
                complete: function ()
                {
                    animatethis(targetElement, speed);
                }
            });
        }
    });
}

// simple accordion/colapsible
var accordions = document.getElementsByClassName("dd-accordion");
for (var i = 0; i < accordions.length; i++) {
  accordions[i].onclick = function() {
    console.log('hello');
    this.classList.toggle('dd-is-open');

    var content = this.nextElementSibling;
    if (content.style.maxHeight) {
      // accordion is currently open, so close it
      content.style.maxHeight = null;
    } else {
      // accordion is currently closed, so open it
      content.style.maxHeight = content.scrollHeight + "px";
    }
  }
}
