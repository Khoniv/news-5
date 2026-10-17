<div>
    <div class="d-flex align-items-center justify-content-between mb-4 pb-2 border-bottom">
        <h4 class="mb-0 editorial-heading">Discussion ({{ $total_comments }})</h4>
        <span class="text-muted small">Join the conversation</span>
    </div>

    <!-- Comment Submission Form (Open for readers) -->
    <form wire:submit.prevent="store" class="mb-4">
        <div class="mb-3">
            <textarea wire:model.defer="body" rows="3"
                class="form-control p-3 @error('body') is-invalid @enderror"
                style="border: 1px solid var(--border-color); background: var(--bg-surface-elevated); border-radius: var(--radius-md); font-size: 14px;"
                placeholder="Share your perspective on this report..."></textarea>
            @error('body')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-dark rounded-pill px-4" style="font-size: 13.5px; font-weight: 600;">
                Post Comment
            </button>
        </div>
    </form>

    <!-- Comments List Feed -->
    <div class="comments-feed">
        @forelse ($comments as $item)
            <div class="comment-item mb-4 pb-3 border-bottom" style="border-color: var(--border-subtle) !important;">
                <div class="d-flex gap-3 align-items-start">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode($item->User->name ?? 'User') }}&background=121417&color=fff&size=44"
                        class="comment-avatar" alt="{{ $item->User->name ?? 'User' }}">
                    <div class="comment-bubble">
                        <div class="d-flex align-items-center justify-content-between mb-1">
                            <span class="comment-author-name">{{ $item->User->name ?? 'Anonymous Reader' }}</span>
                            <span class="comment-time">{{ $item->created_at ? $item->created_at->diffForHumans() : 'Just now' }}</span>
                        </div>
                        <div class="comment-text">
                            {{ $item->body }}
                        </div>

                        <!-- Action Buttons -->
                        <div class="mt-2 d-flex gap-2">
                            @auth
                                <button class="btn btn-sm btn-link p-0 text-muted fw-semibold" style="font-size: 12px; text-decoration: none;"
                                    wire:click="selectReply({{ $item->id }})">Reply</button>
                                @if ($item->user_id == Auth::id())
                                    <button class="btn btn-sm btn-link p-0 text-secondary fw-semibold" style="font-size: 12px; text-decoration: none;"
                                        wire:click="selectEdit({{ $item->id }})">Edit</button>
                                    <button class="btn btn-sm btn-link p-0 text-danger fw-semibold" style="font-size: 12px; text-decoration: none;"
                                        wire:click="delete({{ $item->id }})">Delete</button>
                                @endif
                            @endauth
                        </div>

                        <!-- Reply Inline Form -->
                        @if (isset($comment_id) && $comment_id == $item->id)
                            <form wire:submit.prevent="reply" class="mt-3 pt-3 border-top">
                                <div class="mb-2">
                                    <textarea wire:model.defer="body2" rows="2"
                                        class="form-control p-2 @error('body2') is-invalid @enderror"
                                        style="font-size: 13.5px;"
                                        placeholder="Write a reply..."></textarea>
                                    @error('body2')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="d-flex justify-content-end gap-2">
                                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill" wire:click="$set('comment_id', null)">Cancel</button>
                                    <button type="submit" class="btn btn-sm btn-dark rounded-pill px-3">Reply</button>
                                </div>
                            </form>
                        @endif

                        <!-- Edit Inline Form -->
                        @if (isset($edit_comment_id) && $edit_comment_id == $item->id)
                            <form wire:submit.prevent="change" class="mt-3 pt-3 border-top">
                                <div class="mb-2">
                                    <textarea wire:model.defer="body2" rows="2"
                                        class="form-control p-2 @error('body2') is-invalid @enderror"
                                        style="font-size: 13.5px;"
                                        placeholder="Edit comment..."></textarea>
                                    @error('body2')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="d-flex justify-content-end gap-2">
                                    <button type="button" class="btn btn-sm btn-outline-secondary rounded-pill" wire:click="$set('edit_comment_id', null)">Cancel</button>
                                    <button type="submit" class="btn btn-sm btn-dark rounded-pill px-3">Update</button>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>

                <!-- Nested Replies -->
                @if ($item->childrens && count($item->childrens) > 0)
                    <div class="ms-5 mt-3 ps-2 border-start" style="border-color: var(--border-color) !important;">
                        @foreach ($item->childrens as $item2)
                            <div class="d-flex gap-3 align-items-start mb-3">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($item2->User->name ?? 'User') }}&background=525866&color=fff&size=36"
                                    class="rounded-circle" width="34" height="34" alt="Reply User">
                                <div class="comment-bubble" style="background: var(--bg-surface);">
                                    <div class="d-flex align-items-center justify-content-between mb-1">
                                        <span class="comment-author-name" style="font-size: 13px;">{{ $item2->User->name ?? 'User' }}</span>
                                        <span class="comment-time">{{ $item2->created_at ? $item2->created_at->diffForHumans() : 'Just now' }}</span>
                                    </div>
                                    <div class="comment-text" style="font-size: 13.5px;">
                                        {{ $item2->body }}
                                    </div>
                                    @auth
                                        @if ($item2->user_id == Auth::id())
                                            <div class="mt-1 d-flex gap-2">
                                                <button class="btn btn-sm btn-link p-0 text-secondary fw-semibold" style="font-size: 11px; text-decoration: none;"
                                                    wire:click="selectEdit({{ $item2->id }})">Edit</button>
                                                <button class="btn btn-sm btn-link p-0 text-danger fw-semibold" style="font-size: 11px; text-decoration: none;"
                                                    wire:click="delete({{ $item2->id }})">Delete</button>
                                            </div>
                                        @endif
                                    @endauth
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        @empty
            <div class="text-center py-4 text-muted">
                <p class="mb-0" style="font-size: 14px;">No comments yet. Be the first to share your perspective!</p>
            </div>
        @endforelse
    </div>
</div>
