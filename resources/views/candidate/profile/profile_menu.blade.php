<div class="mb-8 overflow-x-auto overflow-y-hidden hide-scrollbar">
    <div class="inline-flex space-x-1 bg-white p-1.5 rounded-[16px] border border-[#ede8f5] shadow-[0_2px_8px_rgba(0,0,0,0.04)] min-w-max">
        <a href="{{ route('candidate.profile',['section' => 'general']) }}" class="{{ (isset($data['sectionName']) && $data['sectionName'] == 'general') ? 'bg-[#faf7ff] text-[#a100ff] shadow-[0_2px_8px_rgba(161,0,255,0.08)] font-bold border border-[#e1b6ff]' : 'text-[#807287] hover:text-[#4e4256] hover:bg-gray-50 border border-transparent font-semibold' }} flex items-center justify-center py-2.5 px-6 rounded-xl text-[14px] transition-all duration-300 font-['Plus_Jakarta_Sans']">
            {{ __('messages.general') }}
        </a>
        <a href="{{ route('candidate.profile',['section' => 'resume']) }}" class="{{ (isset($data['sectionName']) && $data['sectionName'] == 'resume') ? 'bg-[#faf7ff] text-[#a100ff] shadow-[0_2px_8px_rgba(161,0,255,0.08)] font-bold border border-[#e1b6ff]' : 'text-[#807287] hover:text-[#4e4256] hover:bg-gray-50 border border-transparent font-semibold' }} flex items-center justify-center py-2.5 px-6 rounded-xl text-[14px] transition-all duration-300 font-['Plus_Jakarta_Sans']">
            {{ __('messages.apply_job.resume') }}
        </a>
        <a href="{{ route('candidate.profile',['section' => 'career-informations']) }}" class="{{ (isset($data['sectionName']) && $data['sectionName'] == 'career-informations') ? 'bg-[#faf7ff] text-[#a100ff] shadow-[0_2px_8px_rgba(161,0,255,0.08)] font-bold border border-[#e1b6ff]' : 'text-[#807287] hover:text-[#4e4256] hover:bg-gray-50 border border-transparent font-semibold' }} flex items-center justify-center py-2.5 px-6 rounded-xl text-[14px] transition-all duration-300 font-['Plus_Jakarta_Sans']">
            {{ __('messages.career_informations') }}
        </a>
        <a href="{{ route('candidate.profile',['section' => 'cv-builder']) }}" class="{{ (isset($data['sectionName']) && $data['sectionName'] == 'cv-builder') ? 'bg-[#faf7ff] text-[#a100ff] shadow-[0_2px_8px_rgba(161,0,255,0.08)] font-bold border border-[#e1b6ff]' : 'text-[#807287] hover:text-[#4e4256] hover:bg-gray-50 border border-transparent font-semibold' }} flex items-center justify-center py-2.5 px-6 rounded-xl text-[14px] transition-all duration-300 font-['Plus_Jakarta_Sans']">
            {{  __('messages.cv_builder') }}
        </a>
    </div>
</div>
<style>
.hide-scrollbar::-webkit-scrollbar {
    display: none;
}
.hide-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>
