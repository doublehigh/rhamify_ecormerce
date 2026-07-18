<section class="marketplace_shortcuts">
    <div class="container">
        <div class="marketplace_shortcuts_inner">
            <div class="marketplace_shortcuts_panel category_panel">
                <div class="marketplace_panel_title">Shop by category</div>
                <div class="marketplace_category_grid">
                    @foreach ($homeCategories as $category)
                        <a href="{{route('products.index', ['category' => $category->slug])}}" class="marketplace_category_link">
                            <i class="{{$category->icon ?: 'far fa-box'}}"></i>
                            <span>{{$category->name}}</span>
                        </a>
                    @endforeach
                </div>
            </div>

            <div class="marketplace_shortcuts_panel action_panel">
                <a href="{{route('flash-sale')}}" class="marketplace_action_link">
                    <i class="fas fa-bolt"></i>
                    <span>Flash Sale</span>
                    <small>Limited-time deals</small>
                </a>
                <a href="{{route('vendor.index')}}" class="marketplace_action_link">
                    <i class="fas fa-store"></i>
                    <span>Vendor Stores</span>
                    <small>Shop trusted sellers</small>
                </a>
                <a href="{{route('product-traking.index')}}" class="marketplace_action_link">
                    <i class="fas fa-truck"></i>
                    <span>Track Order</span>
                    <small>Follow delivery status</small>
                </a>
                <a href="{{route('blog')}}" class="marketplace_action_link">
                    <i class="far fa-newspaper"></i>
                    <span>Buying Guides</span>
                    <small>Tips and updates</small>
                </a>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    $(document).ready(function() {
        const categoryRail = $('.marketplace_category_grid');

        if (!categoryRail.length) {
            return;
        }

        let categoryAutoScroll;
        let resumeAutoScroll;

        function stopCategoryAutoScroll() {
            window.clearInterval(categoryAutoScroll);
            window.clearTimeout(resumeAutoScroll);
            categoryRail.stop(true);
        }

        function startCategoryAutoScroll() {
            stopCategoryAutoScroll();

            const rail = categoryRail.get(0);

            if (window.innerWidth > 575 || rail.scrollWidth <= rail.clientWidth) {
                return;
            }

            categoryAutoScroll = window.setInterval(function() {
                const firstItem = categoryRail.find('.marketplace_category_link').first();
                const itemGap = 10;
                const scrollAmount = firstItem.length ? firstItem.outerWidth() + itemGap : 112;
                const maxScroll = rail.scrollWidth - rail.clientWidth;
                const isAtEnd = categoryRail.scrollLeft() >= maxScroll - 4;

                categoryRail.animate({
                    scrollLeft: isAtEnd ? 0 : Math.min(categoryRail.scrollLeft() + scrollAmount, maxScroll)
                }, 650);
            }, 2400);
        }

        function pauseCategoryAutoScroll() {
            stopCategoryAutoScroll();
            resumeAutoScroll = window.setTimeout(startCategoryAutoScroll, 3500);
        }

        categoryRail.on('touchstart pointerdown wheel', pauseCategoryAutoScroll);
        $(window).on('resize load', startCategoryAutoScroll);

        startCategoryAutoScroll();
        window.setTimeout(startCategoryAutoScroll, 800);
    });
</script>
@endpush
