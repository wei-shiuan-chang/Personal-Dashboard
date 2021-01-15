

function openSidebar() {
  
    document.getElementById("mySidebar").style.width = "250px";
    /*document.getElementById("main").style.marginLeft = "250px";*/
    document.getElementById("codeplayer-section").style.padding = "90px";
}

function closeSidebar() {
  
    document.getElementById("mySidebar").style.width = "80px";
    /*document.getElementById("main").style.marginLeft = "80px";*/
    document.getElementById("codeplayer-section").style.paddingLeft ="0";
}

function weatherBG($weather) {

    let weatherBG="";
    if (strpos($weatherArray['weather'][0]['description'], $weather) == true) {
        weatherBG = "img/weather/thunder.jpg";
    }else if(strpos($weatherArray['weather'][0]['description'], $weather) != true && strpos($weatherArray['weather'][0]['description'], "rain") == true){
        weatherBG = "img/weather/rain.jpg";
    }else if(strpos($weatherArray['weather'][0]['description'], $weather) != true){
        weatherBG = "img/weather/snow.jpg";
    }else{
        weatherBG = "img/weather/cloud.jpg";
    }

    document.getElementById("weatherContainer").style.background = weatherBG;
}

$("#weather-link").click(function (e) {
    document.getElementById("weather-section").style.display = none;
});

function weatherS(){
    
    document.getElementById("weather-section").style.display = "block";
    document.getElementById("reaction-section").style.display = "none";
    document.getElementById("codeplayer-section").style.display = "none";
    document.getElementById("todolist-section").style.display = "none";
    //document.getElementById("weather-section").style.width = "450px";
    //document.getElementsById("css-style").setAttribute('href','css/style.css');
    
}

function playerS(){
    /*document.getElementsById("css-style")[0].href = '../css/codeplayer.css';*/
    
    document.getElementById("weather-section").style.display = "none";
    document.getElementById("reaction-section").style.display = "none";
    document.getElementById("codeplayer-section").style.display = "block";
    document.getElementById("todolist-section").style.display = "none";
    //document.getElementsById("codeplayer-section").style.width =  "100%";
    //document.getElementsById("css-style").setAttribute('href','css/codeplayer.css');
    

}

function reactionS(){
    
    document.getElementById("reaction-section").style.display = "block";
    document.getElementById("codeplayer-section").style.display = "none";
    document.getElementById("weather-section").style.display = "none";
    document.getElementById("todolist-section").style.display = "none";
    //document.getElementById("weather-section").style.width = "450px";
    //document.getElementsById("css-style").setAttribute('href','css/style.css');
    
}

function todolistS(){
    
    document.getElementById("todolist-section").style.display = "block";
    document.getElementById("reaction-section").style.display = "none";
    document.getElementById("codeplayer-section").style.display = "none";
    document.getElementById("weather-section").style.display = "none";
    //document.getElementById("weather-section").style.width = "450px";
    //document.getElementsById("css-style").setAttribute('href','css/style.css');
    
}
/*
var display = document.getElementById("weather-section").style.display;
var i;
var links = ["css/style.css","css/codeplayer.css"];
var renew = setInterval(function () {
    document.getElementById("css-style").href = links[i];
    
    if (display == "true") {
        i = 0;
        console.log("true");
    } else {
        i = 1;
    }
}, 500000);
*/

/*codeplayer*/
function updateOutput() {
                
    $("iframe").contents().find("html").html("<html><head><style type='text/css'>" + $("#cssPanel").val() + "</style></head><body>" + $("#htmlPanel").val() + "</body></html>");
    
    document.getElementById("outputPanel").contentWindow.eval($("#javascriptPanel").val());
    
    ;

}

$(".toggleButton").hover(function() {
    
    $(this).addClass("highlightedButton");
    
}, function() {
    
    $(this).removeClass("highlightedButton");
    
})

$(".toggleButton").click(function() {
    
    $(this).toggleClass("active");
    
    $(this).removeClass("highlightedButton");
    
    var panelId = $(this).attr("id") + "Panel";
    
    $("#" + panelId).toggleClass("hidden");
    
    var numberOfActivePanels = 4 - $('.hidden').length;
    
    //$(".panel").width(($(window).width() /numberOfActivePanels) - 10);
    $(".panel").width(($("#codeplayer-section").width() /numberOfActivePanels) - 10);
    
})

$(".panel").height($(window).height() - $("#topbar").height()- 15);


//$(".panel").width(($(window).width() / 2) - 10);
$(".panel").width(($('#codeplayer-section').width()  / 2) - 10);

$("iframe").contents().find("html").html($("#htmlPanel").val());

updateOutput();

$("textarea").on('change keyup paste', function() {

    updateOutput()
    
});


//Reaction
var start = new Date().getTime();
            
//random color
function getRandomColor() {
    var letters = '0123456789ABCDEF'.split('');;
    var color = '#';
    for (var i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}


function makeShapeAppear() {
    
    //random location and size
    
    var top = Math.random() * 400;
    
    var left = Math.random() * 400;
    
    var width = (Math.random() * 200) + 100;
    
    if(Math.random() > 0.5) {
        
        document.getElementById("shape").style.borderRadius = "50%";
        
    }else{
        
        document.getElementById("shape").style.borderRadius = "0";
        
    }
    
    document.getElementById("shape").style.width = width + "px";
    
    document.getElementById("shape").style.height = width + "px";
    
    document.getElementById("shape").style.top = top + "px" ;
    
    document.getElementById("shape").style.left = left + "px" ;
    
    //random color
    
    document.getElementById("shape").style.backgroundColor = getRandomColor();
    
    document.getElementById("shape").style.display = "block";
    
    start = new Date().getTime();
    
}

function appearAfterDelay() {
    
    setTimeout(makeShapeAppear, Math.random() * 2000);
    
}

appearAfterDelay();

document.getElementById("shape").onclick = function() {
    
    document.getElementById("shape").style.display = "none";
    
    var end = new Date().getTime();
    
    var timeTaken = (end - start) / 1000;
    
    document.getElementById("timeTaken").innerHTML = timeTaken + "s";
    
    appearAfterDelay();
}

//Todolist

// Create a "close" button and append it to each list item
var myNodelist = document.getElementsByTagName("LI");
var i;
for (i = 0; i < myNodelist.length; i++) {
  var span = document.createElement("SPAN");
  var txt = document.createTextNode("\u00D7");
  span.className = "close";
  span.appendChild(txt);
  myNodelist[i].appendChild(span);
}

// Click on a close button to hide the current list item
var close = document.getElementsByClassName("close");
var i;
for (i = 0; i < close.length; i++) {
  close[i].onclick = function() {
    var div = this.parentElement;
    div.style.display = "none";
  }
}

// Add a "checked" symbol when clicking on a list item
var list = document.querySelector('ul');
list.addEventListener('click', function(ev) {
  if (ev.target.tagName === 'LI') {
    ev.target.classList.toggle('checked');
  }
}, false);

// Create a new list item when clicking on the "Add" button
function newElement() {
  var li = document.createElement("li");
  var inputValue = document.getElementById("myInput").value;
  var t = document.createTextNode(inputValue);
  li.appendChild(t);
  if (inputValue === '') {
    alert("You must write something!");
  } else {
    document.getElementById("myUL").appendChild(li);
  }
  document.getElementById("myInput").value = "";

  var span = document.createElement("SPAN");
  var txt = document.createTextNode("\u00D7");
  span.className = "close";
  span.appendChild(txt);
  li.appendChild(span);

  for (i = 0; i < close.length; i++) {
    close[i].onclick = function() {
      var div = this.parentElement;
      div.style.display = "none";
    }
  }
}