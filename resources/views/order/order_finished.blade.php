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
                <div class="w-[330px] h-[196px] flex overflow-hidden">
                    <img src="{{Storage::url($productTransaction->shirt->photos()->latest()->first()->photo)}}" class="w-full h-full object-contain" alt="thumbnail">
                </div>
                <div class="flex flex-col w-full max-w-[340px] rounded-[20px] p-[20px_16px_30px_16px] gap-[30px] bg-white">
                    <div class="flex flex-col text-center gap-[10px]">
                        <h1 class="font-bold text-xl leading-[30px]">New Shirt Coming!</h1>
                        <p class="leading-[30px]">Kami akan memeriksa pesanan anda silahkan cek order secara berkala</p>
                    </div>
                    <div class="flex items-center justify-between rounded-2xl border-2 border-[#FFC700] border-dashed p-[12px_16px]">
                        <div class="flex items-center gap-[10px]">
                            <img src="{{ asset('assets/images/icons/delivery.svg')}}" class="w-8 h-8 flex shrink-0" alt="icon">
                            <p>Booking ID <span class="font-bold">{{ $productTransaction->booking_trx_id }}</span></p>
                        </div>
                        <img src="{{ asset('assets/images/icons/verify.svg')}}" class="w-6 h-6" alt="icon">
                    </div>
                    <div class="flex flex-col gap-3">
                        <a href="{{ route('front.index') }}" class="rounded-full p-[12px_20px] text-center w-full bg-[#C5F277] font-bold">Order More</a>
                        <a href="{{ route('front.check_booking') }}" class="rounded-full p-[12px_20px] text-center w-full bg-[#090917] font-bold text-white">View Booking</a>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>