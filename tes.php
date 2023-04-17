<!DOCTYPE html>
<!-- Created By CodingNepal -->
<html lang="en" dir="ltr">
   <head>
      <meta charset="utf-8">
      <title>Owl-carousel Cards Slider | CodingNepal</title>
      <link rel="stylesheet" href="style.css">
      <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
   </head>
   <body>
   <div class="container">
   <div class="section-header">
                            <h2 class="section-title">Festival Budaya di Indonesia</h2>
                        </div>
      <div class="slider owl-carousel">
         <div class="card">
            <div class="img">
               <img src="https://eturbonews.com/wp-content/uploads/2017/03/Indo5.jpg" alt="">
            </div>
            <div class="content">
               <div class="title">
                  Festival Danau Toba
               </div>
               <p>
               Event yang telah dilaksanakan sejak 1970-an yang dulu dikenal dengan sebutan Pesta Danau Toba. Mempersatukan seluruh komponen masyarakat Sumatera Utara untuk berkontribusi meratakan kesejahteraan masyarakat melalui sektor pariwisata dan ekonomi kreatif.
               </p>
               <div class="btn">
                  <button class="btn-primary">Baca selanjutnya</button>
               </div>
            </div>
         </div>
         
      </div>
      <script>
         $(".slider").owlCarousel({
           loop: true,
           autoplay: true,
           autoplayTimeout: 2000, //2000ms = 2s;
           autoplayHoverPause: true,
         });
      </script>
   </body>
   <style>
   @import url('https://fonts.googleapis.com/css?family=Poppins:400,500,600,700&display=swap');
*{
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}

h2, .h2 {
    font-size: 32px;
    font-weight: bold;
}
.slider{
  max-width: 1100px;
  display: flex;
}
.slider .card{
  flex: 1;
  margin: 0 10px;
  background: https://cdn.pixabay.com/photo/2017/06/02/12/14/temple-2366184_1280.jpgfff;
}
.slider .card .img{
  height: 350px;
  width: 100%;
  
}
.slider .card .img img{
  height: 100%;
  width: 100%;
  object-fit: cover;
  border-radius: 5%;
}
.slider .card .content{
  padding-top: 15px;
}
.owl-item .cloned {
    width: 366.667px;
}
.owl-item .cloned .active {
    width: 366.667px;
}
.card .content .title{
  font-size: 25px;
  font-weight: 600;
  text-align: left;
}
.card .content p{
  text-align: justify;
  margin: 10px 0;
}
.card .content .btn{
  display: block;
  margin: 10px 0;
}
.card .content .btn button{
  background: https://cdn.pixabay.com/photo/2017/06/02/12/14/temple-2366184_1280.jpge74c3c;
  color: https://cdn.pixabay.com/photo/2017/06/02/12/14/temple-2366184_1280.jpgfff;
  border: none;
  outline: none;
  font-size: 17px;
  padding: 5px 8px;
  border-radius: 5px;
  cursor: pointer;
  transition: 0.2s;
}
.card .content .btn button:hover{
  transform: scale(0.9);
}
   </style>
</html>