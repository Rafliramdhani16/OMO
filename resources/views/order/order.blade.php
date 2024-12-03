<!doctype html>
<html>
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{asset('output.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet" />
    </head>
    <body>
      <div class="relative flex flex-col w-full max-w-[640px] min-h-screen gap-5 mx-auto bg-[#F5F5F0]">
        <div id="top-bar" class="flex justify-between items-center px-4 mt-[60px]">
            <a href="details.html">
                <img src="{{asset('assets/images/icons/back.svg')}}" class="w-10 h-10" alt="icon">
            </a>
            <p class="font-bold text-lg leading-[27px]">Booking</p>
            <div class="dummy-btn w-10"></div>
        </div>
        @livewire('order-form', ['shirt' => $shirt, 'orderData' => $orderData])
      </div>
    {{-- <script src="asset('js/booking.js')"></script> }}}"></script> --}}
    </body>
</html>