<!DOCTYPE html>
<html lang='ru'>

<head>
    <meta charset='utf-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1, shrink-to-fit=no'>
    <link href="data:image/x-icon;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQEAYAAABPYyMiAAAABmJLR0T///////8JWPfcAAAACXBIWXMAAABIAAAASABGyWs+AAAAF0lEQVRIx2NgGAWjYBSMglEwCkbBSAcACBAAAeaR9cIAAAAASUVORK5CYII=" rel="icon" type="image/x-icon">
    <link rel="stylesheet" href="style.css">
    <title>Добро пожаловать!</title>
    <style>
         main 
         {
            padding-top: 25%;
         }
         .container
         {
            width: 70%;
            margin: auto;
         }
          .invitation__title {
             font-size: 3rem;
             width: 100%;
             margin-bottom: 1rem;
           }
           .invitation__text {
             max-width: 100%;
             margin-bottom: 2rem;
             font-size: 1.6rem;
             font-style: normal;
             font-weight: 200;
             line-height: 130%;
           }
           .invitation__form-inner
           {
             max-width: 100%;
             margin-bottom: 1rem;
             font-size: 1.6rem;
             font-style: normal;
             font-weight: 200;
             line-height: 130%;
           }
           .invitation__wrapper { 
              display: flex;
            }
            .invitation__left
            {
               margin-right: 10rem;
            }
            .all-btn {
              display: flex;
              align-items: center;
              border-radius: 5rem;
              background: #840d06;
              padding: 0.6rem 0.6rem 0.6rem 2.4rem;
              overflow: hidden;
              font-size: 0.8rem;
              font-style: normal;
              font-weight: 500;
              color: #fff;
              line-height: 110%;
            }
            .all-btn span {
              margin-right: 1rem;
              position: relative;
            }
            .all-btn__arrow {
              width: 1.4rem;
              height: 1.4rem;
              border-radius: 50%;
              display: flex;
              justify-content: center;
               align-items: center;
              background: #f9f9f8;
              margin-left: 1.9rem;
            }
            .all-btn__arrow svg {
              width: 1.3rem;
              height: 2.4rem;
              position: relative;
            }
            .all-btn:hover {
                cursor: pointer;
               }
            .all-btn:disabled {
               opacity: 0.5;
               background: #808080;
               cursor: not-allowed;
               }

            .all-btn:disabled .all-btn__arrow path
            {
               opacity: 0.5;
               stroke: #808080;
            }
    </style>
</head>

<body>
   <main>
      <div class="container">
         <div class="invitation__wrapper">
            <div class="invitation__left">
               <div class="invitation__title">Найти запись по комментарию</div>
               <div class="invitation__text">
                  Введите часть комментария (от 3-х символов)
               </div>  
            </div>
            <div class="invitation__right">
               <form action="search.php" method="GET" class="invitation__form">
                  <div class="invitation__form-inner">
                     <label for="">Текст</label>
                     <input name = 'text' id = "text" type="text" placeholder="" />
                  </div>
                  <button class="all-btn" id="search" disabled>
                     <span>Найти</span>
                     <div class="all-btn__arrow">
                        <svg viewBox="0 0 14 26" fill="none" xmlns="http://www.w3.org/2000/svg">
                           <path
                              d="M1.27344 1.54517L12.728 12.9997L1.27344 24.4543"
                              stroke="#840D06"
                              stroke-width="2"
                              stroke-linecap="round"
                              stroke-linejoin="round"
                           />
                        </svg>
                     </div>
                  </button>
               </form>
            </div>
         </div>
      </div>
   </main>
</body>
<script>
const myInput = document.getElementById('text');
const submitButton = document.getElementById('search');

myInput.addEventListener('input', function() {
 const length = myInput.value.length;
 if (length >= 3) {
 submitButton.disabled = false;
 } else {
 submitButton.disabled = true;
 }
});
</script>
</html>