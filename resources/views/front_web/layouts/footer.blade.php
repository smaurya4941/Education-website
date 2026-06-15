<footer id="bw-footer" style="background:#303031; padding-top:80px; padding-bottom:30px;">

    {{-- Top section: brand + links --}}
    <div style="max-width:1200px; margin:0 auto; padding:0 80px 60px; display:grid; grid-template-columns:1.8fr 1fr 1fr 1.4fr; gap:60px;">

        {{-- Brand & Newsletter --}}
        <div>
            <a href="{{ route('front.home') }}" style="display:inline-block; margin-bottom:24px;">
                <img src="{{ getSettingValue('footer_logo') }}" alt="{{ getAppName() }}"
                    style="height:32px; width:auto; object-fit:contain; filter:brightness(0) invert(1); opacity:0.9;" />
            </a>
            <p style="font-size:12px; line-height:1.6; color:#ffffff; margin-bottom:24px; max-width:260px; font-family:'Plus Jakarta Sans', sans-serif; opacity:0.9;">
                Stay Connected with our regular updates by subscribing our newsletter, Premium Recruitment Solutions for professionals.
            </p>

            {{-- Newsletter form --}}
            <form id="newsLetterForm" style="margin-bottom:28px;">
                <div style="display:flex; gap:8px; align-items:center;">
                    <input type="email" id="mc-email" name="email"
                        placeholder="Email Address"
                        style="flex:1; padding:10px 16px; background:#ffffff; border-radius:6px; border:none; outline:none; font-size:12px; color:#303031; font-family:'Plus Jakarta Sans', sans-serif; min-width:0;" />
                    <button type="button"
                        class="btnLetterSave"
                        style="width:36px; height:36px; border-radius:6px; background:#a100ff; border:none; cursor:pointer; display:flex; align-items:center; justify-content:center; transition:opacity 0.2s;"
                        title="Subscribe"
                        onmouseover="this.style.opacity='0.85';" onmouseout="this.style.opacity='1';">
                        <span class="material-symbols-outlined" style="color:#ffffff; font-size:18px;">send</span>
                    </button>
                </div>
            </form>

            {{-- Social icons --}}
            <div style="display:flex; gap:12px;">
                @if (!empty($settings['facebook_url']))
                    <a href="{{ $settings['facebook_url'] }}" target="_blank" style="width:32px; height:32px; border-radius:50%; border:1px solid rgba(255,255,255,0.3); display:flex; align-items:center; justify-content:center; color:#ffffff; text-decoration:none; font-size:12px; transition:all 0.2s;" onmouseover="this.style.borderColor='#a100ff'; this.style.color='#a100ff';" onmouseout="this.style.borderColor='rgba(255,255,255,0.3)'; this.style.color='#ffffff';">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                @endif
                @if (!empty($settings['twitter_url']))
                    <a href="{{ $settings['twitter_url'] }}" target="_blank" style="width:32px; height:32px; border-radius:50%; border:1px solid rgba(255,255,255,0.3); display:flex; align-items:center; justify-content:center; color:#ffffff; text-decoration:none; font-size:12px; transition:all 0.2s;" onmouseover="this.style.borderColor='#a100ff'; this.style.color='#a100ff';" onmouseout="this.style.borderColor='rgba(255,255,255,0.3)'; this.style.color='#ffffff';">
                        <i class="fa-brands fa-twitter"></i>
                    </a>
                @endif
            </div>
        </div>

        {{-- Useful Links --}}
        <div>
            <h4 style="font-size:14px; font-weight:600; color:#ffffff; font-family:'Plus Jakarta Sans', sans-serif; margin:0 0 20px; letter-spacing:0;">Useful Links</h4>
            <ul style="list-style:none; padding:0; margin:0; display:flex; flex-direction:column; gap:12px;">
                <li><a href="{{ url('/') }}" style="font-size:12px; color:#ffffff; opacity:0.8; text-decoration:none; font-family:'Plus Jakarta Sans', sans-serif; transition:opacity 0.2s;" onmouseover="this.style.opacity='1';" onmouseout="this.style.opacity='0.8';">Home</a></li>
                <li><a href="{{ route('front.search.jobs') }}" style="font-size:12px; color:#ffffff; opacity:0.8; text-decoration:none; font-family:'Plus Jakarta Sans', sans-serif; transition:opacity 0.2s;" onmouseover="this.style.opacity='1';" onmouseout="this.style.opacity='0.8';">Jobs</a></li>
                <li><a href="{{ route('front.company.lists') }}" style="font-size:12px; color:#ffffff; opacity:0.8; text-decoration:none; font-family:'Plus Jakarta Sans', sans-serif; transition:opacity 0.2s;" onmouseover="this.style.opacity='1';" onmouseout="this.style.opacity='0.8';">Companies</a></li>
                <li><a href="{{ route('employer.register') }}" style="font-size:12px; color:#ffffff; opacity:0.8; text-decoration:none; font-family:'Plus Jakarta Sans', sans-serif; transition:opacity 0.2s;" onmouseover="this.style.opacity='1';" onmouseout="this.style.opacity='0.8';">Employer Solutions</a></li>
                <li><a href="{{ route('candidate.register') }}" style="font-size:12px; color:#ffffff; opacity:0.8; text-decoration:none; font-family:'Plus Jakarta Sans', sans-serif; transition:opacity 0.2s;" onmouseover="this.style.opacity='1';" onmouseout="this.style.opacity='0.8';">Job Seekers</a></li>
            </ul>
        </div>

        {{-- Helpful Resources --}}
        <div>
            <h4 style="font-size:14px; font-weight:600; color:#ffffff; font-family:'Plus Jakarta Sans', sans-serif; margin:0 0 20px; letter-spacing:0;">Helpful Resources</h4>
            <ul style="list-style:none; padding:0; margin:0; display:flex; flex-direction:column; gap:12px;">
                <li><a href="{{ route('front.about.us') }}" style="font-size:12px; color:#ffffff; opacity:0.8; text-decoration:none; font-family:'Plus Jakarta Sans', sans-serif; transition:opacity 0.2s;" onmouseover="this.style.opacity='1';" onmouseout="this.style.opacity='0.8';">About Us</a></li>
                <li><a href="{{ route('front.contact') }}" style="font-size:12px; color:#ffffff; opacity:0.8; text-decoration:none; font-family:'Plus Jakarta Sans', sans-serif; transition:opacity 0.2s;" onmouseover="this.style.opacity='1';" onmouseout="this.style.opacity='0.8';">Contact Us</a></li>
                <li><a href="{{ route('front.post.lists') }}" style="font-size:12px; color:#ffffff; opacity:0.8; text-decoration:none; font-family:'Plus Jakarta Sans', sans-serif; transition:opacity 0.2s;" onmouseover="this.style.opacity='1';" onmouseout="this.style.opacity='0.8';">Blog</a></li>
                <li><a href="{{ route('privacy.policy.list') }}" style="font-size:12px; color:#ffffff; opacity:0.8; text-decoration:none; font-family:'Plus Jakarta Sans', sans-serif; transition:opacity 0.2s;" onmouseover="this.style.opacity='1';" onmouseout="this.style.opacity='0.8';">Privacy Policy</a></li>
                <li><a href="{{ route('terms.conditions.list') }}" style="font-size:12px; color:#ffffff; opacity:0.8; text-decoration:none; font-family:'Plus Jakarta Sans', sans-serif; transition:opacity 0.2s;" onmouseover="this.style.opacity='1';" onmouseout="this.style.opacity='0.8';">Terms And Conditions</a></li>
            </ul>
        </div>

        {{-- Contact --}}
        <div>
            <h4 style="font-size:14px; font-weight:600; color:#ffffff; font-family:'Plus Jakarta Sans', sans-serif; margin:0 0 20px; letter-spacing:0;">Contact Us</h4>
            <div style="display:flex; flex-direction:column; gap:20px;">
                <div style="display:flex; align-items:flex-start; gap:12px;">
                    <span class="material-symbols-outlined" style="color:#a100ff; font-size:18px; margin-top:2px;">call</span>
                    <a href="tel:{{ $settings['region_code'] }}{{ $settings['phone'] }}" style="font-size:12px; color:#ffffff; opacity:0.8; line-height:1.5; font-family:'Plus Jakarta Sans', sans-serif; text-decoration:none; transition:opacity 0.2s;" onmouseover="this.style.opacity='1';" onmouseout="this.style.opacity='0.8';">
                        {{ $settings['region_code'] . ' ' . $settings['phone'] }}
                    </a>
                </div>
                <div style="display:flex; align-items:flex-start; gap:12px;">
                    <span class="material-symbols-outlined" style="color:#a100ff; font-size:18px; margin-top:2px;">location_on</span>
                    <span style="font-size:12px; color:#ffffff; opacity:0.8; line-height:1.6; font-family:'Plus Jakarta Sans', sans-serif;">
                        3rd Floor, ITHUM TOWER, 307B, A-40,<br>Sector 62, Noida, Uttar<br>Pradesh 201301
                    </span>
                </div>
                <div style="display:flex; align-items:flex-start; gap:12px;">
                    <span class="material-symbols-outlined" style="color:#a100ff; font-size:18px; margin-top:2px;">mail</span>
                    <a href="mailto:{{ $settings['email'] }}" style="font-size:12px; color:#ffffff; opacity:0.8; line-height:1.5; font-family:'Plus Jakarta Sans', sans-serif; text-decoration:none; transition:opacity 0.2s;" onmouseover="this.style.opacity='1';" onmouseout="this.style.opacity='0.8';">
                        info@bizwoke.in
                    </a>
                </div>
            </div>
        </div>

    </div>

    {{-- Divider --}}
    <div style="max-width:1200px; margin:0 auto; padding:0 80px;">
        <div style="height:1px; background:rgba(255,255,255,0.1);"></div>
    </div>

    {{-- Bottom bar --}}
    <div style="max-width:1200px; margin:0 auto; padding:24px 80px 0; display:flex; justify-content:space-between; align-items:center; flex-wrap:wrap; gap:16px;">
        <p style="font-size:12px; color:#ffffff; opacity:0.8; margin:0; font-family:'Plus Jakarta Sans', sans-serif;">
            &copy; 2026 <a href="{{ getSettingValue('company_url') }}" style="color:#a100ff; text-decoration:none; font-weight:600;">Bizwoke</a>. All Rights Reserved.
        </p>
        <div style="display:flex; gap:24px;">
            <a href="{{ route('privacy.policy.list') }}" style="font-size:12px; color:#ffffff; opacity:0.8; text-decoration:none; font-family:'Plus Jakarta Sans', sans-serif; transition:opacity 0.2s;" onmouseover="this.style.opacity='1';" onmouseout="this.style.opacity='0.8';">Privacy</a>
            <a href="{{ url('/cookies') }}" style="font-size:12px; color:#ffffff; opacity:0.8; text-decoration:none; font-family:'Plus Jakarta Sans', sans-serif; transition:opacity 0.2s;" onmouseover="this.style.opacity='1';" onmouseout="this.style.opacity='0.8';">Cookies</a>
            <a href="{{ url('/security') }}" style="font-size:12px; color:#ffffff; opacity:0.8; text-decoration:none; font-family:'Plus Jakarta Sans', sans-serif; transition:opacity 0.2s;" onmouseover="this.style.opacity='1';" onmouseout="this.style.opacity='0.8';">Security</a>
        </div>
    </div>

</footer>
