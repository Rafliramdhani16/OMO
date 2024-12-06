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
            <div id="top-bar" class="flex justify-between items-center px-4 mt-[60px]">
                <a href="{{ route('front.check_booking') }}">
                    <img src="{{asset('assets/images/icons/back.svg')}}" class="w-10 h-10" alt="icon">
                </a>
                <p class="font-bold text-lg leading-[27px]">Booking Details</p>
                <div class="dummy-btn w-10"></div>
            </div>
            <section id="your-order" class="accordion flex flex-col rounded-[20px] p-4 pb-5 gap-5 mx-4 bg-white overflow-hidden transition-all duration-300 has-[:checked]:!h-[66px]">
                <label class="group flex items-center justify-between">
                    <h2 class="font-bold text-xl leading-[30px]">Your Order</h2>
                    <img src="{{asset('assets/images/icons/arrow-up.svg')}}" class="w-7 h-7 transition-all duration-300 group-has-[:checked]:rotate-180" alt="icon">
                    <input type="checkbox" class="hidden">
                </label>
                <div class="flex items-center gap-[14px]">
                    <div class="flex shrink-0 w-20 h-20 rounded-[20px] p-1 overflow-hidden">
                        <img src="{{Storage::url($orderDetails->shirt->photos()->latest()->first()->photo)}}" class="w-full h-full object-contain" alt="">
                    </div>
                    <h3 class="font-bold text-lg leading-6">
                    {{ $orderDetails->shirt->name }}
                    </h3>
                </div>
                <hr class="border-[#EAEAED]">
                <div class="flex items-center justify-between">
                    <p class="font-semibold">Brand</p>
                    <p class="font-bold">{{ $orderDetails->shirt->brand->name }}</p>
                </div>
                <div class="flex items-center justify-between">
                    <p class="font-semibold">Price</p>
                    <p class="font-bold">Rp {{number_format($orderDetails->shirt->price, 0, ',', '.')}}</p>
                </div>
                <div class="flex items-center justify-between">
                    <p class="font-semibold">Quantity</p>
                    <p class="font-bold">{{ $orderDetails->quantity }}</p>
                </div>
                <div class="flex items-center justify-between">
                    <p class="font-semibold">Shirt Size</p>
                    <p class="font-bold">{{ $orderDetails->shirtSize->size }}</p>
                </div>
                <div class="flex items-center justify-between">
                    <p class="font-semibold">Grand Total</p>
                    <p class="font-bold text-2xl leading-9 text-[#07B704]">
                    Rp {{number_format($orderDetails->grand_total_amount, 0, ',', '.')}}
                    </p>
                </div>
                <div class="flex items-center justify-between">
                    <p class="font-semibold">Checkout At</p>
                    <p class="font-bold">{{ $orderDetails->created_at }}</p>
                </div>
                @if ($orderDetails->is_paid)
                <div class="flex items-center justify-between">
                    <p class="font-semibold">Status</p>
                    <p class="rounded-full p-[6px_14px] bg-[#2A2A2A] font-bold text-sm leading-[21px] text-white">SUCCESS</p>
                </div>
                @else
                <div class="flex items-center justify-between">
                    <p class="font-semibold">Status</p>
                    <p class="rounded-full p-[6px_14px] bg-[#07B704] font-bold text-sm leading-[21px] text-white">PENDING</p>
                </div>
                @endif
            </section>
            <section id="customer" class="accordion flex flex-col rounded-[20px] p-4 pb-5 gap-5 mx-4 bg-white overflow-hidden transition-all duration-300 has-[:checked]:!h-[66px] mb-10">
                <label class="group flex items-center justify-between">
                    <h2 class="font-bold text-xl leading-[30px]">Customer</h2>
                    <img src="{{asset('assets/images/icons/arrow-up.svg')}}" class="w-7 h-7 transition-all duration-300 group-has-[:checked]:rotate-180" alt="icon">
                    <input type="checkbox" class="hidden">
                </label>
                <div class="flex items-center gap-5">
                    <img src="{{asset('assets/images/icons/delivery.svg')}}" class="w-6 h-6 flex shrink-0" alt="icon">
                    <div class="flex flex-col gap-[6px]">
                        <p class="font-semibold">Booking ID</p>
                        <p class="font-bold">{{ $orderDetails->booking_trx_id }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-5">
                    <img src="{{asset('assets/images/icons/user.svg')}}" class="w-6 h-6 flex shrink-0" alt="icon">
                    <div class="flex flex-col gap-[6px]">
                        <p class="font-semibold">Name</p>
                        <p class="font-bold">{{ $orderDetails->name }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-5">
                    <img src="{{asset('assets/images/icons/call.svg')}}" class="w-6 h-6 flex shrink-0" alt="icon">
                    <div class="flex flex-col gap-[6px]">
                        <p class="font-semibold">Phone No.</p>
                        <p class="font-bold">{{ $orderDetails->phone }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-5">
                    <img src="{{asset('assets/images/icons/sms.svg')}}" class="w-6 h-6 flex shrink-0" alt="icon">
                    <div class="flex flex-col gap-[6px]">
                        <p class="font-semibold">Email</p>
                        <p class="font-bold">{{ $orderDetails->email }}</p>
                    </div>
                </div>
                <div class="flex items-center gap-5">
                    <img src="{{asset('assets/images/icons/house-2.svg')}}" class="w-6 h-6 flex shrink-0" alt="icon">
                    <div class="flex flex-col gap-[6px]">
                        <p class="font-semibold">Delivery to</p>
                        <p class="font-bold">{{ $orderDetails->address }},{{ $orderDetails->post_code }},{{ $orderDetails->city }}</p>
                    </div>
                </div>
                <hr class="border-[#EAEAED]">
                <a href="#" class="rounded-full p-[12px_20px] text-center w-full bg-[#C5F277] font-bold">Call Customer Service</a>
                <hr class="border-[#EAEAED]">
                <div class="flex items-center gap-[10px]">
                    <img src="{{asset('assets/images/icons/shield-tick.svg')}}" class="w-8 h-8 flex shrink-0" alt="icon">
                    <p class="leading-[26px]">Kami melindungi data privasi anda dengan baik bantuan Angga X.</p>
                </div>
            </section>
        </div>

        <script src="{{ asset('js/accordion.js') }}"></script>
    </body>
</html>