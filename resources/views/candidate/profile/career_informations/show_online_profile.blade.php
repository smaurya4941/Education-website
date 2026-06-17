<div class="col flex flex-wrap gap-3">
    @if(isset($user->facebook_url))
        <a href="{{ addLinkHttpUrl($user->facebook_url) }}" target="_blank" id="facebook_url" 
           class="w-10 h-10 flex items-center justify-center rounded-full bg-[#faf7ff] text-[#1877F2] border border-[#ede8f5] hover:bg-[#1877F2] hover:text-white transition-all duration-300 shadow-sm">
            <i class="fab fa-facebook-f text-lg"></i>
        </a>
    @endif
    @if(isset($user->twitter_url))
        <a href="{{ addLinkHttpUrl($user->twitter_url) }}" target="_blank" id="twitter_url" 
           class="w-10 h-10 flex items-center justify-center rounded-full bg-[#faf7ff] text-[#1DA1F2] border border-[#ede8f5] hover:bg-[#1DA1F2] hover:text-white transition-all duration-300 shadow-sm">
            <i class="fab fa-twitter text-lg"></i>
        </a>
    @endif
    @if(isset($user->linkedin_url))
        <a href="{{ addLinkHttpUrl($user->linkedin_url) }}" target="_blank" id="linkedin_url" 
           class="w-10 h-10 flex items-center justify-center rounded-full bg-[#faf7ff] text-[#0A66C2] border border-[#ede8f5] hover:bg-[#0A66C2] hover:text-white transition-all duration-300 shadow-sm">
            <i class="fab fa-linkedin-in text-lg"></i>
        </a>
    @endif
    @if(isset($user->google_plus_url))
        <a href="{{ addLinkHttpUrl($user->google_plus_url) }}" target="_blank" id="google_plus_url" 
           class="w-10 h-10 flex items-center justify-center rounded-full bg-[#faf7ff] text-[#DB4437] border border-[#ede8f5] hover:bg-[#DB4437] hover:text-white transition-all duration-300 shadow-sm">
            <i class="fab fa-google-plus-g text-lg"></i>
        </a>
    @endif
    @if(isset($user->pinterest_url))
        <a href="{{ addLinkHttpUrl($user->pinterest_url) }}" target="_blank" id="pinterest_url" 
           class="w-10 h-10 flex items-center justify-center rounded-full bg-[#faf7ff] text-[#E60023] border border-[#ede8f5] hover:bg-[#E60023] hover:text-white transition-all duration-300 shadow-sm">
            <i class="fab fa-pinterest-p text-lg"></i>
        </a>
    @endif
</div>

