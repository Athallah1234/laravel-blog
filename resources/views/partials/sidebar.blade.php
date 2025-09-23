      <div class="sidebar" data-aos="fade-left">
        <!-- Search -->
        <div class="mb-4">
          <input type="text" class="form-control" placeholder="Search...">
        </div>

        <!-- Categories -->
        <div class="mb-2 d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Categories</h5>
          <a href="{{ route('categories.index') }}" class="btn btn-link btn-sm p-0">More</a>
        </div>
        <ul class="list-unstyled">
          @foreach($categories as $category)
            <li><a href="{{ route('category.show', $category->slug) }}">{{ $category->name }}</a></li>
          @endforeach
        </ul>

        <!-- Tags -->
        <div class="mb-2 d-flex justify-content-between align-items-center">
          <h5 class="mb-0">Tags</h5>
          <a href="{{ route('tags.index') }}" class="btn btn-link btn-sm p-0">More</a>
        </div>
        <div class="tag-cloud">
          @foreach($tags as $tag)
            <a href="{{ route('tag.show', $tag->slug) }}">{{ $tag->name }}</a>
          @endforeach
        </div>

        <!-- Recent Posts -->
        <div class="mb-4">
          <h5>Recent Posts</h5>
          <ul class="list-unstyled">
            @foreach($recentPosts as $recent)
              <li class="mb-3">
                <a href="{{ route('post.show', $recent->slug) }}" class="d-flex align-items-center p-2 border rounded-3 text-decoration-none" style="transition: 0.3s; border-color:#dee2e6;">
                  <!-- Thumbnail -->
                  <img src="{{ asset('storage/' . $recent->avatar) }}" alt="{{ $recent->title }}" class="me-2 rounded" style="width: 60px; height: 60px; object-fit: cover;">

                  <!-- Title -->
                  <div class="flex-grow-1">
                    <p class="mb-0 fw-semibold text-dark" style="font-size: 0.9rem;">
                      {{ Str::limit($recent->title, 50) }}
                    </p>
                    <small class="text-muted">
                      {{ \Carbon\Carbon::parse($recent->publish_date)->format('M d, Y') }}
                    </small>
                  </div>
                </a>
              </li>
            @endforeach
          </ul>
        </div>

        <!-- Newsletter -->
        <div class="mb-4 p-3 rounded-3" style="background: rgba(255,255,255,0.7);backdrop-filter: blur(8px);">
          <h5>Subscribe</h5>
          <p>Get the latest updates directly in your inbox.</p>
          <form>
            <div class="mb-2">
              <input type="email" class="form-control form-control-sm" placeholder="Email">
            </div>
            <button type="submit" class="btn btn-primary btn-sm w-100">Subscribe</button>
          </form>
        </div>
      </div>