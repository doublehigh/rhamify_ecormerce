<section class="marketplace_shortcuts">
    <div class="container">
        <div class="marketplace_shortcuts_inner">
            <div class="marketplace_shortcuts_panel category_panel">
                <div class="marketplace_panel_title">Shop by category</div>
                <div class="marketplace_category_viewport">
                    <div class="marketplace_category_grid">
                        @foreach ($homeCategories as $category)
                            <a href="{{route('products.index', ['category' => $category->slug])}}" class="marketplace_category_link">
                                <i class="{{$category->icon ?: 'far fa-box'}}"></i>
                                <span>{{$category->name}}</span>
                            </a>
                        @endforeach

                        @foreach ($homeCategories as $category)
                            <a href="{{route('products.index', ['category' => $category->slug])}}" class="marketplace_category_link marketplace_category_duplicate" aria-hidden="true" tabindex="-1">
                                <i class="{{$category->icon ?: 'far fa-box'}}"></i>
                                <span>{{$category->name}}</span>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="marketplace_shortcuts_panel marketplace_action_viewport">
                <div class="action_panel">
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

                    <a href="{{route('flash-sale')}}" class="marketplace_action_link marketplace_action_duplicate" aria-hidden="true" tabindex="-1">
                        <i class="fas fa-bolt"></i>
                        <span>Flash Sale</span>
                        <small>Limited-time deals</small>
                    </a>
                    <a href="{{route('vendor.index')}}" class="marketplace_action_link marketplace_action_duplicate" aria-hidden="true" tabindex="-1">
                        <i class="fas fa-store"></i>
                        <span>Vendor Stores</span>
                        <small>Shop trusted sellers</small>
                    </a>
                    <a href="{{route('product-traking.index')}}" class="marketplace_action_link marketplace_action_duplicate" aria-hidden="true" tabindex="-1">
                        <i class="fas fa-truck"></i>
                        <span>Track Order</span>
                        <small>Follow delivery status</small>
                    </a>
                    <a href="{{route('blog')}}" class="marketplace_action_link marketplace_action_duplicate" aria-hidden="true" tabindex="-1">
                        <i class="far fa-newspaper"></i>
                        <span>Buying Guides</span>
                        <small>Tips and updates</small>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
