<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>SimpleSite Footer</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  <!-- Stiluri pentru Footer -->
  <style>
    /* Footer styling */
    footer {
      background-color: #1a202c; /* bg-gray-900 */
      color: white;
      padding: 2rem 0; /* py-8 */
    }

    /* Containerul footer-ului */
    footer .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 0 1.5rem; /* px-6 */
    }

    /* Flexbox pentru structura coloanelor */
    footer .flex {
      display: flex;
      justify-content: space-between;
      gap: 1.5rem;
      flex-wrap: wrap; /* adăugat pentru a face footer-ul responsiv */
    }

    /* Coloană 1: Descriere site */
    footer .w-1\/3 {
      width: 33.33%;
    }

    footer .w-1\/3 h4 {
      font-size: 1.125rem; /* text-lg */
      font-weight: 600; /* font-semibold */
      margin-bottom: 0.5rem; /* mb-2 */
    }

    footer .w-1\/3 p {
      font-size: 0.875rem;
    }

    /* Coloană 2: Linkuri utile */
    footer .w-1\/3 ul {
      list-style: none;
      padding: 0;
    }

    footer .w-1\/3 ul li {
      margin-bottom: 0.5rem;
    }

    footer .w-1\/3 ul li a {
      text-decoration: none;
      color: inherit;
      transition: color 0.3s;
    }

    footer .w-1\/3 ul li a:hover {
      text-decoration: underline;
      color: #fbd38d; /* hover:underline */
    }

    /* Coloană 3: Contact */
    footer .w-1\/3 ul {
      list-style: none;
      padding: 0;
    }

    footer .w-1\/3 ul li {
      margin-bottom: 0.5rem;
    }

    footer .w-1\/3 ul li a {
      text-decoration: none;
      color: inherit;
      transition: color 0.3s;
    }

    footer .w-1\/3 ul li a:hover {
      text-decoration: underline;
      color: #fbd38d; /* hover:underline */
    }

    /* Separator */
    footer .border-t {
      border-top: 1px solid #2d3748; /* border-gray-700 */
      margin-top: 2rem; /* mt-8 */
      padding-top: 1rem; /* pt-4 */
    }

    /* Text centralizat pentru footer */
    footer .text-center {
      text-align: center;
      font-size: 0.875rem; /* text-sm */
    }

    footer .text-sm {
      font-size: 0.875rem;
    }
  </style>
</head>
<body>

<footer class="bg-gray-900 text-white py-8">
  <div class="container mx-auto px-6">
    <div class="flex justify-between">
      <!-- Coloană 1: Descriere site -->
      <div class="w-1/3">
        <h4 class="text-lg font-semibold mb-2">SimpleSite</h4>
        <p>&copy; 2025 SimpleSite. All rights reserved.</p>
      </div>

      <!-- Coloană 2: Linkuri utile -->
      <div class="w-1/3">
        <h4 class="text-lg font-semibold mb-2">Useful Links</h4>
        <ul>
          <li><a href="#" class="hover:underline">Home</a></li>
          <li><a href="#" class="hover:underline">About Us</a></li>
          <li><a href="#" class="hover:underline">Services</a></li>
          <li><a href="#" class="hover:underline">Contact</a></li>
        </ul>
      </div>

      <!-- Coloană 3: Contact -->
      <div class="w-1/3">
        <h4 class="text-lg font-semibold mb-2">Contact</h4>
        <ul>
          <li><a href="mailto:info@simplesite.com" class="hover:underline">Email Us</a></li>
          <li><a href="#" class="hover:underline">Social Media</a></li>
        </ul>
      </div>
    </div>

    <!-- Separator -->
    <div class="mt-8 border-t border-gray-700 pt-4">
      <p class="text-center text-sm">Made with ❤️ by SimpleSite Team</p>
    </div>
  </div>
</footer>

</body>
</html>
