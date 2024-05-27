<!DOCTYPE html>
<html lang="en">
<head>
<style>
        

        .shop_nav {
            background-color: var(--white);
            box-shadow: var(--box-shadow);
            padding: 2rem;
            padding-left:200px;
            padding-right:200px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin: 0 auto;
            position: relative;
        }
        
        .shop_nav a {
            margin: 0 1rem;
            font-size: 1.75rem;
            color: var(--light-color);
        }
        
        .shop_nav a:hover {
            color: var(--purple);
            text-decoration: none;
        }
        
        .dropdown-content {
        display: none;
        position: absolute;
        background-color: #fff;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
        top: 100%; /* Position the dropdown below the navigation links */
        width: 100%; /* Make the dropdown span the whole width */
    }
        
        .dropdown-content a {
           color: #333;
           padding: 12px 16px;
           text-decoration: none;
           display: block;
        }
        
        
        .dropdown-content a:hover {
           background-color: #f2f2f2;
        }
        
        
        
        /* Additional styles for responsiveness */
        @media screen and (max-width: 768px) {
            .shop_nav {
                flex-direction: column;
                align-items: stretch;
                padding: 1rem;
            }
        
            .shop_nav a {
                margin: 0.5rem 0;
            }
        
            .dropdown-content {
               display: block;
               position: fixed;
               top: 0;
               left: 100%; /* Position to the right of the navigation links */
               width: 200px;
               box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
            }
        
            .shop_nav:active {
                position: static;
            }
        }
        
        
        
        
        </style>
</head>
<body>
   
</body>
</html>

<div class="shop_nav">
            <a href="category1.php?category=makeup" class="makeup">Makeup</a>
            <div class="dropdown-content makeup-content">
                <a href="category2.php?category=face">face</a>
                <a href="category2.php?category=eye">eye</a>
                <a href="category2.php?category=nails">nails</a>
                <a href="category2.php?category=lips">lips</a>
           </div>
            <a href="category1.php?category=haircare" class="hair">hair care</a>
            <div class="dropdown-content hair-content">
                <a href="category2.php?category=naturaloil">natural oil</a>
                <a href="category2.php?category=shampoo">shampoo and conditioner</a>
                <a href="category2.php?category=haircoloring">hair coloring</a>
                <a href="category2.php?category=hairvax">hair wax</a>
                <a href="category2.php?category=hairspray">hair spray</a>
           </div>

            <a href="category1.php?category=skincare" class="skin">skin care</a>
            <div class="dropdown-content skin-content">
                <a href="category2.php?category=cleansing">cleansing</a>
                <a href="category2.php?category=eyecare">eye care</a>
                <a href="category2.php?category=acnecare">acne care</a>
                <a href="category2.php?category=myfairness">my fairness</a>
                <a href="category2.php?category=nightcare&moisturizer">night care & moisturizer</a>
                <a href="category2.php?category=sunprotection">sun protection</a>
                <a href="category2.php?category=masks">masks</a>
           </div>
            <a href="category1.php?category=tools" class="tools">tools</a>
            <div class="dropdown-content tools-content">
                <a href="category2.php?category=brushers">brushes</a>
                <a href="category2.php?category=spongers">spongers</a>
                <a href="category2.php?category=scissors">scissors</a>
                
           </div>
            
</div>
   
<script>
document.addEventListener("DOMContentLoaded", function() {
   const makeupLink = document.querySelector(".makeup");
   const haircareLink = document.querySelector(".hair");
   const skincareLink = document.querySelector(".skin");
   const toolsLink = document.querySelector(".tools");

   const makeupContent = document.querySelector(".makeup-content");
   const haircareContent = document.querySelector(".hair-content");
   const skincareContent = document.querySelector(".skin-content");
   const toolsContent = document.querySelector(".tools-content");

   const allLinks = [makeupLink, haircareLink, skincareLink, toolsLink];
   const allContents = [makeupContent, haircareContent, skincareContent, toolsContent];

   let timeout;

   function showContent(content) {
      content.style.display = "block";
   }

   function hideAllContents() {
      allContents.forEach(content => {
         content.style.display = "none";
      });
   }

   allLinks.forEach((link, index) => {
      link.addEventListener("mouseover", function() {
         clearTimeout(timeout);
         hideAllContents();
         showContent(allContents[index]);
      });

      link.addEventListener("mouseout", function(event) {
         const relatedTarget = event.relatedTarget || event.toElement;
         if (!relatedTarget || (!relatedTarget.closest(".shop_nav") && !relatedTarget.closest(".dropdown-content"))) {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
               hideAllContents();
            }, 100); 
         }
      });

      allContents[index].addEventListener("mouseover", function() {
         clearTimeout(timeout);
      });

      allContents[index].addEventListener("mouseout", function(event) {
         const relatedTarget = event.relatedTarget || event.toElement;
         if (!relatedTarget || !relatedTarget.closest(".shop_nav")) {
            clearTimeout(timeout);
            timeout = setTimeout(() => {
               hideAllContents();
            }, 100); 
         }
      });
   });
});
</script>


