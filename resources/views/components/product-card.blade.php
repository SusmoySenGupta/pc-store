<div class="flex flex-wrap justify-center gap-4 -m-4">
    @forelse ($products as $product)
        <div class="flex flex-col justify-between w-full p-4 rounded lg:w-1/4 md:w-1/2 hover:shadow-lg">
            <div>
                <a href="{{ route('product.show', $product) }}" class="relative block h-48 overflow-hidden rounded">
                    <img alt="product" 
                    src="{{ $product->images->count() ? Storage::url($product?->images?->first()?->path) : 'https://dummyimage.com/500x300' }}"
                    class="block object-cover object-center w-full h-full" 
                    >
                </a>
                <div class="mt-4">
                    <h3 class="mb-1 text-xs tracking-widest text-gray-500 title-font">{{ $product->category->name }}</h3>
                    <a href="{{ route('product.show', $product) }}" class="text-lg font-medium text-gray-900 title-font">{{ $product->name }}</a>
                    <div class="mt-1">
                        <span class="text-2xl">৳</span>
                        <span class="@if ($product->price != $product->offer_price) line-through @endif">{{ number_format($product->price, 2, '.', ',') }}</span>
                        @if ($product->price != $product->offer_price)
                            <span>{{ number_format($product->offer_price, 2, '.', ',') }}</span>
                        @endif
                    </div>
                </div>
            </div>
            <form action="{{ route('cart.store') }}" class="mt-4" method="POST">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button class="px-2 py-1 border rounded hover:bg-gray-50">
                    Buy now
                </button>
            </form>
        </div>
    @empty
        <p class="text-xl animate-pulse">Products coming soon!</p>
    @endforelse
</div>
