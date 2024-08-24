@php
    use Illuminate\Support\Facades\Storage;
@endphp

<x-dashboard-layout :title="$title = 'Post|Index'">
    <!-- Table Start -->
    <div class="container-fluid posts-table-container pt-4 px-4">
        <div class="row g-4">
            <div class="col-12">
                <div class="buttons-group">
                    <a href="{{ route('post.create') }}" class="btn btn-primary btn-sm shadow-none mb-2 text-white">
                        {{ __('posts.create_new') }}
                    </a>

                    @if(count($posts))
                        <button class="btn btn-secondary btn-sm shadow-none mb-2 text-white" id="softDeleteSelectedPostsBtn">
                            {{ __('posts.delete.soft_delete_selected') }}
                        </button>

                        <button class="btn btn-danger btn-sm shadow-none mb-2 text-white" id="deleteSelectedPostsBtn">
                            {{ __('posts.delete.delete_selected') }}
                        </button>

                        <button class="btn btn-secondary btn-sm shadow-none mb-2 text-white" id="softDeleteAllPostsBtn">
                            {{ __('posts.delete.soft_delete_all') }}
                        </button>

                        <button class="btn btn-danger btn-sm shadow-none mb-2 text-white" id="deleteAllPostsBtn">
                            {{ __('posts.delete.delete_all') }}
                        </button>
                    @endif
                </div>

                <div class="bg-light_ rounded h-100 p-4">
                    <h6 class="mb-4">{{ __('posts.posts') }}</h6>

                    <div class="table-responsive posts-table">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    {{--<th>
                                        <input type="checkbox" class="select-all-posts" id="selectAllPosts">
                                    </th>--}}
                                    <th></th>
                                    <th scope="col">#</th>
                                    <th scope="col">{{ __('posts.title') }}</th>
                                    <th scope="col">{{ __('posts.short_description') }}</th>
                                    <th scope="col">{{ __('posts.index.active') }}</th>
                                    <th scope="col">{{ __('posts.created_at') }}</th>
                                    <th scope="col">{{ __('posts.index.image') }}</th>
                                    <th></th>
                                </tr>
                            </thead>

                            <tbody>
                            @foreach($posts as $post)
                                @php
                                    $image = $post->image ? Storage::url('posts/' . $post->image) : asset('images/post_thumbnail.svg');
                                @endphp

                                <tr>
                                    <td>
                                        <input type="checkbox"
                                               class="checkbox_ post-checkbox"
                                               id="postCheckBox_{{ $post->id }}"
                                               value="{{ $post->id }}"
                                        >
                                    </td>
                                    <td>{{ $post->id }}</td>
                                    <td>{{ $post->postText->title }}</td>
                                    <td>{{ Str::words($post->postText->short_description, 50) }}</td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" type="checkbox" role="switch" @php echo $post->active ? 'checked' : '' @endphp disabled>
                                        </div>
                                    </td>
                                    <td>{{ $post->created_at_diff }}</td>
                                    <td>
                                        <img class="post-image" src="{{ $image }}" alt="{{ $post->postText->title }}">
                                    </td>
                                    <td>
                                        <div class="table-actions-icons-block">
                                            <div>
                                                <a class="btn btn-primary btn-sm"
                                                   title="{{ __('posts.view_icon_link_title') }}"
                                                   href="{{ route('post.show', $post->id) }}">
                                                    <i class="fa-solid fa-eye"></i>
                                                </a>
                                            </div>

                                            <div>
                                                <a class="btn btn-info btn-sm text-white"
                                                   title="{{ __('posts.edit_icon_link_title') }}"
                                                   href="{{ route('post.edit', ['id' => $post->id, 'page' => $posts->currentPage()]) }}">
                                                    <i class="fa-solid fa-edit"></i>
                                                </a>
                                            </div>

                                            <div>
                                                <form action="{{ route('post.copy', $post->id) }}" id="postCopyForm"
                                                      method="post">
                                                    @csrf

                                                    <button class="btn btn-success btn-sm" type="submit"
                                                            title="{{ __('posts.copy_icon_link_title') }}">
                                                        <i class="fa-solid fa-copy"></i>
                                                    </button>
                                                </form>
                                            </div>

                                            <div>
                                                <form action="{{ route('post.soft-delete', $post->id) }}" id="postSoftDeleteForm"
                                                      method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button class="btn btn-secondary btn-sm" type="submit"
                                                            onclick="return confirmDelete('{{ __('posts.alert.are_you_sure') }}')"
                                                            title="{{ __('posts.soft_delete_icon_link_title') }}">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>

                                            <div>
                                                <form action="{{ route('post.delete', $post->id) }}" id="postDeleteForm"
                                                      method="post">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button class="btn btn-danger btn-sm" type="submit"
                                                            onclick="return confirmDelete('{{ __('posts.alert.are_you_sure') }}')"
                                                            title="{{ __('posts.delete_icon_link_title') }}">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-5 mb-5">
            {{ $posts->onEachSide(5)->links() }}
        </div>
    </div>
    <!-- Table End -->

    @push('scripts')
        <script>
            const postsMessages = {
                confirm: '{{ __('posts.alert.are_you_sure') }}',
                success: '{{ __('posts.alert.deleted_successfully') }}',
                error: '{{ __('posts.alert.something_went_wrong') }}',
                pleaseSelectAtLeastOne: '{{ __('posts.alert.please_select_at_least_one_post_to_delete') }}',
            };

            deleteMultiple('{{ route("post.delete-multiple") }}', '#deleteSelectedPostsBtn', '.post-checkbox', postsMessages);
            softDeleteMultiple('{{ route("post.soft-delete-multiple") }}', '#softDeleteSelectedPostsBtn', '.post-checkbox', postsMessages);
            deleteAll('{{ route("post.delete-all") }}', '#deleteAllPostsBtn', postsMessages);
            softDeleteAll('{{ route("post.soft-delete-all") }}', '#softDeleteAllPostsBtn', postsMessages);

            //selectAll('#selectAllPosts', '.post-checkbox');
        </script>
    @endpush
</x-dashboard-layout>
