var num = 0;
var pic = new Array();
pic[0] = "slideshow/image1.jpg";
pic[1] = "slideshow/image2.jpg";
pic[2] = "slideshow/image3.jpg";
pic[3] = "slideshow/image4.jpg";
pic[4] = "slideshow/image5.jpg";
pic[5] = "slideshow/image6.jpg";
pic[6] = "slideshow/image7.jpg";
pic[7] = "slideshow/image8.jpg";
pic[8] = "slideshow/image9.jpg";
pic[9] = "slideshow/image10.jpg";

function nextImg() 
{
    num++;
    if (num > pic.length - 1)
        num = 0;
    $(document).ready(function () {
        $('#img').fadeOut(1000);
        setTimeout("$('#img').attr('src', pic[num])", 2000);
        setTimeout("$('#img').fadeIn(700)", 2000);
    });
}

function backImg() 
{
    num--;
    if (num < 0)
        num = pic.length - 1;
    $(document).ready(function () {
        $('#img').fadeOut(1000);
        setTimeout("$('#img').attr('src', pic[num])", 2000);
        setTimeout("$('#img').fadeIn(700)", 2000);
    });
}