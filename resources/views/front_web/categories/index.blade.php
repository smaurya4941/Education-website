@extends('front_web.layouts.app')

@section('title')
    {{ __('web.job_seekers') }}
@endsection

@section('page_css')
<style>
    /* ── Tokens ─────────────────────────────────── */
    :root {
        --bwc-blue:        #1E5DA3;
        --bwc-blue-light:  #e8f0fb;
        --bwc-green:       #5dba2f;
        --bwc-green-light: #e6f7db;
        --bwc-on-bg:       #1b1c1c;
        --bwc-muted:       #6b7280;
        --bwc-border:      #e5e7eb;
        --bwc-bg:          #f5f6f8;
        --bwc-white:       #ffffff;
        --bwc-font:        'Plus Jakarta Sans', sans-serif;
        --bwc-radius:      12px;
        --bwc-shadow-hov:  0 8px 28px rgba(0,0,0,0.10);
    }

    .bwc-page { font-family: var(--bwc-font); }

    /* ── Section wrapper ─────────────────────────── */
    .bwc-grid-section {
        background: var(--bwc-bg);
        padding: 56px 0 72px;
    }
    .bwc-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 40px;
    }

    /* ── Section heading row ─────────────────────── */
    .bwc-sec-head {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 32px;
        gap: 16px;
        flex-wrap: wrap;
    }
    .bwc-sec-head h2 {
        font-size: 26px;
        font-weight: 700;
        color: var(--bwc-on-bg);
        margin: 0 0 4px;
        letter-spacing: -0.01em;
    }
    .bwc-sec-head p {
        font-size: 13px;
        color: var(--bwc-blue);
        margin: 0;
        font-weight: 500;
    }
    .bwc-sec-head p strong { font-weight: 700; }

    /* Nav arrow buttons */
    .bwc-nav-btns {
        display: flex;
        gap: 6px;
        flex-shrink: 0;
        margin-top: 4px;
    }
    .bwc-nav-btns button {
        width: 34px; height: 34px;
        border-radius: 50%;
        border: 1px solid var(--bwc-border);
        background: var(--bwc-white);
        color: var(--bwc-muted);
        display: flex; align-items: center; justify-content: center;
        cursor: pointer;
        transition: border-color 0.18s, color 0.18s, background 0.18s;
        box-shadow: 0 1px 4px rgba(0,0,0,0.05);
    }
    .bwc-nav-btns button .material-symbols-outlined { font-size: 18px; }
    .bwc-nav-btns button:hover {
        border-color: var(--bwc-blue);
        color: var(--bwc-blue);
        background: var(--bwc-blue-light);
    }

    /* ── Grid ───────────────────────────────────── */
    .bwc-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
    }
    @media (max-width: 1080px) { .bwc-grid { grid-template-columns: repeat(3, 1fr); } }
    @media (max-width: 720px)  { .bwc-grid { grid-template-columns: repeat(2, 1fr); } }
    @media (max-width: 480px)  { .bwc-grid { grid-template-columns: 1fr; } }

    /* ── Card ───────────────────────────────────── */
    .bwc-card {
        background: var(--bwc-white);
        border: 1px solid var(--bwc-border);
        border-radius: var(--bwc-radius);
        padding: 22px 20px 20px;
        display: flex;
        flex-direction: column;
        text-decoration: none;
        color: inherit;
        transition: transform 0.28s cubic-bezier(0.34,1.56,0.64,1),
                    box-shadow 0.25s ease;
        cursor: pointer;
    }
    .bwc-card:hover {
        transform: translateY(-3px);
        box-shadow: var(--bwc-shadow-hov);
    }

    /* Icon */
    .bwc-card__icon {
        width: 42px; height: 42px;
        border-radius: 9px;
        background: var(--bwc-blue-light);
        display: flex; align-items: center; justify-content: center;
        margin-bottom: 14px;
        flex-shrink: 0;
        transition: background 0.25s;
    }
    .bwc-card__icon img {
        width: 24px; height: 24px;
        object-fit: contain;
    }
    .bwc-card:hover .bwc-card__icon {
        background: rgba(30, 93, 163, 0.12);
        box-shadow: 0 0 0 3px rgba(30, 93, 163, 0.08);
    }

    /* Title */
    .bwc-card__title {
        font-size: 15px;
        font-weight: 700;
        line-height: 1.35;
        color: var(--bwc-blue);
        margin: 0 0 10px;
    }
    .bwc-card--disabled .bwc-card__title { color: var(--bwc-on-bg); }

    /* Count badge */
    .bwc-badge {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 999px;
        font-size: 11px;
        font-weight: 700;
        margin-bottom: 14px;
        letter-spacing: 0.01em;
    }
    .bwc-badge--green { background: var(--bwc-green-light); color: var(--bwc-green); }
    .bwc-badge--grey  { background: #f3f4f6; color: #9ca3af; }

    /* Action row */
    .bwc-card__action {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 13px;
        font-weight: 600;
        color: var(--bwc-on-bg);
        margin-top: auto;
        transition: gap 0.2s;
    }
    .bwc-card__action .material-symbols-outlined { font-size: 17px; }
    .bwc-card:hover .bwc-card__action { gap: 10px; }

    .bwc-card__action--none {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 12px;
        color: #b0b7c3;
        margin-top: auto;
    }
    .bwc-card__action--none .material-symbols-outlined { font-size: 15px; }

    /* Empty state */
    .bwc-empty {
        background: var(--bwc-bg);
        padding: 80px 40px;
        text-align: center;
        font-family: var(--bwc-font);
    }
    .bwc-empty .material-symbols-outlined { font-size: 56px; color: #d1d5db; display: block; margin-bottom: 16px; }
    .bwc-empty h3 { font-size: 22px; font-weight: 700; color: var(--bwc-on-bg); margin: 0 0 8px; }
    .bwc-empty p  { font-size: 14px; color: var(--bwc-muted); margin: 0; }

    /* No-results message (JS-driven) */
    #bwcNoResults {
        display: none;
        text-align: center;
        padding: 48px 0 0;
        font-size: 15px;
        color: var(--bwc-muted);
        font-family: var(--bwc-font);
    }

    @media (max-width: 768px) {
        .bwc-container { padding-left: 20px; padding-right: 20px; }
        .bwc-grid-section { padding: 40px 0 56px; }
    }
</style>
@endsection

@section('content')
<div class="bwc-page">

    {{-- ══════════════════════════════════════════
         CATEGORIES GRID
    ══════════════════════════════════════════ --}}
    @if (count($jobCategories) > 0)
    <section class="bwc-grid-section">
        <div class="bwc-container">

            {{-- Section header --}}
            <div class="bwc-sec-head">
                <div>
                    <h2>Specialized Sectors</h2>
                </div>
                <!-- <div class="bwc-nav-btns">
                    <button onclick="bwcScroll(-1)" title="Previous">
                        <span class="material-symbols-outlined">chevron_left</span>
                    </button>
                    <button onclick="bwcScroll(1)" title="Next">
                        <span class="material-symbols-outlined">chevron_right</span>
                    </button>
                </div> -->
            </div>

            {{-- Cards grid --}}
            <div class="bwc-grid" id="bwcGrid">
                @foreach ($jobCategories as $jobCategory)
                    @php
                        $cnt      = $jobCategory->jobs_count ?? 0;
                        $hasJobs  = $cnt > 0;
                        $cardName = strtolower(strip_tags(html_entity_decode($jobCategory->name)));
                    @endphp

                    @if ($hasJobs)
                    <a href="{{ route('front.search.jobs', ['categories' => $jobCategory->id]) }}"
                       class="bwc-card"
                       data-name="{{ $cardName }}">
                    @else
                    <div class="bwc-card bwc-card--disabled" data-name="{{ $cardName }}">
                    @endif

                        {{-- Icon --}}
                        <div class="bwc-card__icon">
                            <img src="{{ $jobCategory->image_url }}" alt="{{ html_entity_decode($jobCategory->name) }}">
                        </div>

                        {{-- Title --}}
                        <h3 class="bwc-card__title">{{ html_entity_decode($jobCategory->name) }}</h3>

                        {{-- Count badge --}}
                        <span class="bwc-badge {{ $hasJobs ? 'bwc-badge--green' : 'bwc-badge--grey' }}">
                            {{ $cnt }} {{ __('web.open_positions') }}
                        </span>

                        {{-- Action --}}
                        @if ($hasJobs)
                            <div class="bwc-card__action">
                                View Jobs
                                <span class="material-symbols-outlined">arrow_forward</span>
                            </div>
                        @else
                            <div class="bwc-card__action--none">
                                No current positions
                                <span class="material-symbols-outlined">lock</span>
                            </div>
                        @endif

                    @if ($hasJobs)
                    </a>
                    @else
                    </div>
                    @endif
                @endforeach
            </div>

            <p id="bwcNoResults">No categories match your search.</p>
        </div>
    </section>

    @else
    <div class="bwc-empty">
        <span class="material-symbols-outlined">inbox</span>
        <h3>No Categories Found</h3>
        <p>There are currently no job categories available. Please check back later.</p>
    </div>
    @endif

</div>
@endsection

@section('page_js')
<script>
(function () {
    var cards = document.querySelectorAll('#bwcGrid .bwc-card');
    var noRes = document.getElementById('bwcNoResults');

    window.bwcScroll = function(dir) {
        var grid = document.getElementById('bwcGrid');
        if (grid) grid.scrollBy({ left: dir * 320, behavior: 'smooth' });
    };
})();
</script>
@endsection
