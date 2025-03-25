<!DOCTYPE html>

<html lang="en">
    <!-- BEGIN: Head -->
    <head>
        <meta charset="utf-8">
        <link href="dist/images/logo.svg" rel="shortcut icon">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="PT JEEVESINDO GEMILANG">
        <meta name="keywords" content="PT JEEVESINDO GEMILANG">
        <meta name="author" content="piizaa">
        <title>KPI - JEEVES</title>
        <!-- BEGIN: CSS Assets-->
        <link rel="stylesheet" href="dist/css/app.css" />
        <!-- END: CSS Assets-->
    </head>
    <!-- END: Head -->
    <body class="login">
        <div class="container sm:px-10">
            <div class="block xl:grid grid-cols-2 gap-4">
                <!-- BEGIN: Login Info -->
                <div class="hidden xl:flex flex-col min-h-screen">
                    <a href="" class="-intro-x flex items-center pt-5">
                        <img alt="PT JEEVESINDO GEMILANG" width="100px" src="dist/images/logo.png">
                        <span class="hidden xl:block text-white text-lg ml-3">KPI<br>
                        <span style="font-size: 16px;background: white;color: #1c3faa;padding: 5px;border-radius: 5px;font-weight: bold;">KEY PERFORMACE INDICATOR</span></span>
                    </a>
                    <div class="my-auto">
                        <img alt="Midone Tailwind HTML Admin Template" class="-intro-x w-1/2 -mt-16" src="dist/images/finding-signatures.gif" style="border-radius: 30px;">
                        <div class="-intro-x text-white font-medium text-4xl leading-tight mt-10">
                            PT. JEEVESINDO GEMILANG
                    
                        
                        </div>
                        <div class="-intro-x mt-5 text-lg text-white">Sistem Monitoring KPI JEEVES</div>
                    </div>
                </div>
                <!-- END: Login Info -->
                <!-- BEGIN: Login Form -->
                <div class="h-screen xl:h-auto flex py-5 xl:py-0 my-10 xl:my-0">
                    <div class="my-auto mx-auto xl:ml-20 bg-white xl:bg-transparent px-5 sm:px-8 py-8 xl:p-0 rounded-md shadow-md xl:shadow-none w-full sm:w-3/4 lg:w-2/4 xl:w-auto">
                        <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
                            Sign In
                        </h2>
                        <div class="intro-x mt-2 text-gray-500 xl:hidden text-center">PT. JEEVESINDO GEMILANG </div>
                        <form method="POST" action="action/auth_proses">
                        <div class="intro-x mt-8">
                            <input type="text" class="intro-x login__input input input--lg border border-gray-300 block" name="username" placeholder="NIK" required="">
                            <input type="password" class="intro-x login__input input input--lg border border-gray-300 block mt-4" name="password" placeholder="PIN" required="">
                        </div>
 
                        <div class="intro-x mt-5 xl:mt-8 text-center xl:text-left">
                            <button class="button button--lg w-full xl:w-32 text-white bg-theme-1 xl:mr-3">Login</button>
                       
                        </div>
                        </form>
                      
                    </div>
                </div>
                <!-- END: Login Form -->
            </div>
        </div>
        <!-- BEGIN: JS Assets-->
        <script src="dist/js/app.js"></script>
        <!-- END: JS Assets-->
    </body>
</html>