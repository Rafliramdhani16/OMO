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
                <a href="{{ route('front.index') }}">
                    <img src="{{asset('assets/images/icons/back.svg')}}" class="w-10 h-10" alt="icon">
                </a>
                <p class="font-bold text-lg leading-[27px]">Category</p>
                <div class="dummy-btn w-10"></div>
            </div>
            <div class="px-4">
                <div class="flex items-center justify-between w-full rounded-2xl overflow-hidden bg-white">
                    <div class="flex flex-col gap-[2px] px-[30px] pr-4">
                        <h3 class="font-bold text-[22px] leading-[33px]">{{ $category->name }}</h3>
                        <p class="text-[#878785]">{{ $category->shirts->count() }} Shirts</p>
                    </div>
                    <div class="flex shrink-0 w-[140px] h-[120px] overflow-hidden">
                        <img src="{{ Storage::url($category->icon) }}" class="w-full h-full object-cover object-left" alt="thumbnail">
                    </div>
                </div>
            </div>
            <section id="fresh" class="flex flex-col gap-4 px-4 mb-[111px]">
                <div class="flex items-center justify-between">
                    <h2 class="font-bold leading-[20px]">Fresh From <br>Great Designers</h2>
                    <a href="#" class="rounded-full p-[6px_14px] border border-[#2A2A2A] text-xs leading-[18px]">
                        View All
                    </a>
                </div>
                <div class="flex flex-col gap-4">

                  @forelse ($category->shirts as $itemShirt)
                      <a href="{{ route('front.details', $itemShirt->slug) }}l">
                        <div class="flex items-center rounded-3xl p-[10px_16px_16px_10px] gap-[14px] bg-white transition-all duration-300 hover:ring-2 hover:ring-[#FFC700]">
                            <div class="w-20 h-20 flex shrink-0 rounded-2xl overflow-hidden">
                                <img src={{Storage::url($itemShirt->thumbnail)}}" class="w-full h-full object-cover" alt="thumbnail">
                            </div>
                            <div class="flex w-full items-center justify-between gap-[14px]">
                                <div class="flex flex-col gap-[6px]">
                                    <h3 class="font-bold leading-[20px]">{{ $itemShirt->name }}</h3>
                                    <p class="text-sm leading-[21px] text-[#878785]">{{ $itemShirt->category->name }}</p>
                                </div>
                                <div class="flex flex-col gap-1 items-end shrink-0">
                                    <div class="flex">
                                        <img src="{{asset('assets/images/icons/Star 1.svg')}}" class="w-[18px] h-[18px] flex shrink-0" alt="star">
                                        <img src="{{asset('assets/images/icons/Star 1.svg')}}" class="w-[18px] h-[18px] flex shrink-0" alt="star">
                                        <img src="{{asset('assets/images/icons/Star 1.svg')}}" class="w-[18px] h-[18px] flex shrink-0" alt="star">
                                        <img src="{{asset('assets/images/icons/Star 1.svg')}}" class="w-[18px] h-[18px] flex shrink-0" alt="star">
                                        <img src="{{asset('assets/images/icons/Star 1.svg')}}" class="w-[18px] h-[18px] flex shrink-0" alt="star">
                                    </div>
                                    <p class="font-semibold text-sm leading-[21px]">4.5</p>
                                </div>
                            </div>
                        </div>
                    </a>
                  @empty
                    <p>Belum ada data terbaru</p>
                  @endforelse



                    
                </div>
            </section>
        </div>
    </body>
</html>