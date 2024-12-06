<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="{{asset('output.css')}}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet" />
    </head>
    <body>
        <div class="relative flex flex-col w-full max-w-[640px] min-h-screen gap-5 mx-auto bg-[#F5F5F0]">
            <div class="flex flex-col items-center justify-center px-4 gap-[30px] my-auto">
                <form method="POST" action="{{ route('front.check_booking_details') }}" class="flex flex-col w-full max-w-[330px] rounded-[30px] p-5 gap-6 bg-white">
                @csrf
                    <img src="{{asset('assets/images/icons/3d-cube-search.svg')}}" class="w-[90px] h-[90px] mx-auto" alt="icon">
                    <h1 class="font-bold text-2xl leading-9 text-center">Check My Order</h1>
                    <div class="flex flex-col gap-2">
                        <label for="booking-id" class="font-semibold leading-[21px]">Booking ID</label>
                        <div class="flex items-center w-full rounded-full px-[14px] gap-[10px] overflow-hidden bg-[#F8F8F9] transition-all duration-300 focus-within:ring-2 focus-within:ring-[#FFC700]">
                            <img src="{{asset('assets/images/icons/delivery.svg')}}" class="w-6 h-6 flex shrink-0" alt="icon">
                            <input type="text" name="booking_trx_id" id="booking-id" class="appearance-none outline-none bg-[#F8F8F9] w-full font-semibold leading-[21px] placeholder:font-normal py-[14px]" placeholder="What’s your booking ID">
                        </div>
                    </div>
                    <div class="flex flex-col gap-2">
                        <label for="phone" class="font-semibold leading-[21px]">Phone Number</label>
                        <div class="flex items-center w-full rounded-full px-[14px] gap-[10px] overflow-hidden bg-[#F8F8F9] transition-all duration-300 focus-within:ring-2 focus-within:ring-[#FFC700]">
                            <img src="{{asset('assets/images/icons/call.svg')}}" class="w-6 h-6 flex shrink-0" alt="icon">
                            <input type="tel" name="phone" id="phone" class="appearance-none outline-none bg-[#F8F8F9] w-full font-semibold leading-[21px] placeholder:font-normal py-[14px]" placeholder="What’s your number">
                        </div>
                    </div>
                    <div class="flex flex-col gap-3">
                        <button type="submit" class="rounded-full p-[12px_20px] text-center w-full bg-[#C5F277] font-bold">Find Booking</button>
                    </div>
                </div>
                <div id="bottom-nav" class="relative flex h-[100px] w-full shrink-0">
                    <nav class="fixed bottom-5 w-full max-w-[640px] px-4 z-30">
                        <div class="grid grid-flow-col auto-cols-auto items-center justify-between rounded-full bg-[#2A2A2A] p-2 px-[30px]">
                            <a href="{{ route('front.index') }}" class="mx-auto w-full">
                                <img src="{{asset('assets/images/icons/3dcube-white.svg')}}" class="w-6 h-6" alt="icon">
                            </a>
                            <a href="{{ route('front.check_booking') }}" class="active flex shrink-0 -mx-[22px]">
                                <div class="flex items-center rounded-full gap-[10px] p-[12px_16px] bg-[#C5F277]">
                                    <img src="{{asset('assets/images/icons/bag-2.svg')}}" class="w-6 h-6" alt="icon">
                                    <span class="font-bold text-sm leading-[21px]">My Order</span>
                                </div>
                            </a>
                            <a href="#" class="mx-auto w-full">
                                <img src="{{asset('assets/images/icons/star-white.svg')}}" class="w-6 h-6" alt="icon">
                            </a>
                            <a href="#" class="mx-auto w-full">
                                <img src="{{asset('assets/images/icons/24-support-white.svg')}}" class="w-6 h-6" alt="icon">
                            </a>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </body>
</html>