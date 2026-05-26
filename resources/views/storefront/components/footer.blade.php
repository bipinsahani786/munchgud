<footer class="footer">
    <div style="padding: 5rem 0 2rem;">
        <div class="container-xl">
            <!-- Top Section -->
            <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 3rem; margin-bottom: 3.5rem;">
                <!-- Brand -->
                <div>
                    <h3 style="font-family: var(--heading-font); font-size: 2rem; color: #fff; margin-bottom: 1rem;">
                        Munch<span style="color: var(--secondary);">Gud</span>
                    </h3>
                    <p style="font-size: 0.9375rem; line-height: 1.7; margin-bottom: 1.5rem; max-width: 280px;">
                        Premium roasted makhana straight from the farms of Bihar. High protein, gluten-free, irresistibly crunchy.
                    </p>
                    <div style="display: flex; gap: 0.75rem;">
                        <!-- Instagram -->
                        @if(!empty($global_settings['social_instagram']))
                        <a href="{{ $global_settings['social_instagram'] }}" target="_blank" style="width: 40px; height: 40px; border-radius: 50%; background: rgba(255,255,255,0.08); display: flex; align-items: center; justify-content: center; transition: all 0.3s;" onmouseover="this.style.background='#E1306C'" onmouseout="this.style.background='rgba(255,255,255,0.08)'">
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/></svg>
                        </a>
                        @endif
                        <!-- Facebook -->
                        @if(!empty($global_settings['social_facebook']))
                        <a href="{{ $global_settings['social_facebook'] }}" target="_blank" style="width: 40px; height: 40px; border-radius: 50%; background: rgba(255,255,255,0.08); display: flex; align-items: center; justify-content: center; transition: all 0.3s;" onmouseover="this.style.background='#1877F2'" onmouseout="this.style.background='rgba(255,255,255,0.08)'">
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/></svg>
                        </a>
                        @endif
                        <!-- Twitter/X -->
                        @if(!empty($global_settings['social_twitter']))
                        <a href="{{ $global_settings['social_twitter'] }}" target="_blank" style="width: 40px; height: 40px; border-radius: 50%; background: rgba(255,255,255,0.08); display: flex; align-items: center; justify-content: center; transition: all 0.3s;" onmouseover="this.style.background='#000000'" onmouseout="this.style.background='rgba(255,255,255,0.08)'">
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/></svg>
                        </a>
                        @endif
                        <!-- YouTube -->
                        @if(!empty($global_settings['social_youtube']))
                        <a href="{{ $global_settings['social_youtube'] }}" target="_blank" style="width: 40px; height: 40px; border-radius: 50%; background: rgba(255,255,255,0.08); display: flex; align-items: center; justify-content: center; transition: all 0.3s;" onmouseover="this.style.background='#FF0000'" onmouseout="this.style.background='rgba(255,255,255,0.08)'">
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path d="M23.498 6.186a3.016 3.016 0 00-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 00.502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 002.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 002.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/></svg>
                        </a>
                        @endif
                        <!-- Reels -->
                        @if(!empty($global_settings['social_reels']))
                        <a href="{{ $global_settings['social_reels'] }}" target="_blank" style="width: 40px; height: 40px; border-radius: 50%; background: rgba(255,255,255,0.08); display: flex; align-items: center; justify-content: center; transition: all 0.3s;" onmouseover="this.style.background='#E1306C'" onmouseout="this.style.background='rgba(255,255,255,0.08)'">
                            <svg width="18" height="18" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" clip-rule="evenodd" d="M4 3a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V5a2 2 0 0 0-2-2H4zm1 2h3.5l-2 3H3V6a1 1 0 0 1 1-1zm6 0h3.5l-2 3H8L11 5zm6 0h3l1 1v2h-2.5l-1.5-3zm1 5h-12v8a1 1 0 0 0 1 1h10a1 1 0 0 0 1-1v-8zm-8 1.5v5l4-2.5-4-2.5z"/></svg>
                        </a>
                        @endif
                    </div>
                </div>

                <!-- Quick Links -->
                <div>
                    <h4 style="color: #fff; font-weight: 600; font-size: 0.9375rem; text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 1.25rem;">Quick Links</h4>
                    <ul style="list-style: none; display: flex; flex-direction: column; gap: 0.75rem;">
                        <li><a href="#" style="font-size: 0.9375rem;">Shop All</a></li>
                        <li><a href="#" style="font-size: 0.9375rem;">Our Story</a></li>
                        <li><a href="#" style="font-size: 0.9375rem;">Bulk Orders</a></li>
                        <li><a href="#" style="font-size: 0.9375rem;">Track Order</a></li>
                        <li><a href="#" style="font-size: 0.9375rem;">Blog</a></li>
                    </ul>
                </div>

                <!-- Support -->
                <div>
                    <h4 style="color: #fff; font-weight: 600; font-size: 0.9375rem; text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 1.25rem;">Support</h4>
                    <ul style="list-style: none; display: flex; flex-direction: column; gap: 0.75rem;">
                        <li><a href="#" style="font-size: 0.9375rem;">Contact Us</a></li>
                        <li><a href="#" style="font-size: 0.9375rem;">FAQs</a></li>
                        <li><a href="#" style="font-size: 0.9375rem;">Shipping Policy</a></li>
                        <li><a href="#" style="font-size: 0.9375rem;">Return & Refund</a></li>
                        <li><a href="#" style="font-size: 0.9375rem;">Privacy Policy</a></li>
                    </ul>
                </div>

                <!-- Contact / Newsletter -->
                <div>
                    <h4 style="color: #fff; font-weight: 600; font-size: 0.9375rem; text-transform: uppercase; letter-spacing: 0.08em; margin-bottom: 1.25rem;">Stay Connected</h4>
                    <p style="font-size: 0.875rem; margin-bottom: 1rem;">Get exclusive offers & new flavour alerts straight to your inbox.</p>
                    <form style="display: flex; gap: 0;">
                        <input type="email" placeholder="Your email" style="flex: 1; padding: 0.75rem 1rem; border: none; border-radius: 9999px 0 0 9999px; font-size: 0.875rem; background: rgba(255,255,255,0.1); color: #fff; outline: none;" onfocus="this.style.background='rgba(255,255,255,0.15)'" onblur="this.style.background='rgba(255,255,255,0.1)'">
                        <button type="submit" style="padding: 0.75rem 1.5rem; border: none; border-radius: 0 9999px 9999px 0; background: var(--secondary); color: #fff; font-weight: 600; cursor: pointer; font-size: 0.875rem; transition: all 0.3s;" onmouseover="this.style.filter='brightness(1.1)'" onmouseout="this.style.filter='brightness(1)'">
                            →
                        </button>
                    </form>
                    <p style="font-size: 0.75rem; color: rgba(255,255,255,0.4); margin-top: 0.5rem;">No spam, unsubscribe anytime.</p>
                </div>
            </div>

            <!-- Divider -->
            <div style="border-top: 1px solid rgba(255,255,255,0.1); padding-top: 2rem; display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 1rem;">
                <p style="font-size: 0.8125rem; color: rgba(255,255,255,0.4);">
                    © {{ date('Y') }} MunchGud™. All rights reserved. Made with ❤️ in India.
                </p>
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <span style="font-size: 0.75rem; color: rgba(255,255,255,0.4);">We accept</span>
                    <span style="background: rgba(255,255,255,0.1); padding: 0.25rem 0.625rem; border-radius: 4px; font-size: 0.6875rem; font-weight: 600; color: rgba(255,255,255,0.6);">UPI</span>
                    <span style="background: rgba(255,255,255,0.1); padding: 0.25rem 0.625rem; border-radius: 4px; font-size: 0.6875rem; font-weight: 600; color: rgba(255,255,255,0.6);">Cards</span>
                    <span style="background: rgba(255,255,255,0.1); padding: 0.25rem 0.625rem; border-radius: 4px; font-size: 0.6875rem; font-weight: 600; color: rgba(255,255,255,0.6);">COD</span>
                    <span style="background: rgba(255,255,255,0.1); padding: 0.25rem 0.625rem; border-radius: 4px; font-size: 0.6875rem; font-weight: 600; color: rgba(255,255,255,0.6);">Net Banking</span>
                </div>
            </div>
        </div>
    </div>
</footer>
