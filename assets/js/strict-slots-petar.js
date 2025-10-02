/* Strict start times for provider "Petar" only (public + backend) */
(function(){
  'use strict';
  const ALLOWED = [
    "08:00","08:45","09:15","10:00","10:45","11:15",
    "12:00","12:45","13:15","14:00","14:45","15:15",
    "16:00","16:45","17:15"
  ];
  const OK = new Set(ALLOWED);

  function norm(s){
    if(!s) return null;
    s = String(s).trim().toUpperCase().replace(/\./g,':').replace(/\s*(AM|PM)\s*$/,'');
    const m = /^(\d{1,2}):(\d{2})$/.exec(s);
    if(!m) return null;
    return m[1].padStart(2,'0') + ':' + m[2];
  }

  function currentProviderName(root){
    // Try common provider selectors in both public + backend forms
    const guesses = [
      'select[name="provider_id"] option:checked',
      '#provider-id option:checked',
      'select[name="provider"] option:checked',
      '.provider select option:checked'
    ];
    for(const g of guesses){
      const o = root.querySelector(g);
      if(o && o.textContent) return o.textContent.trim();
    }
    return null;
  }

  function looksLikeTimeSelect(sel){
    if(!(sel instanceof HTMLSelectElement)) return false;
    const c = Array.from(sel.options).filter(o => norm(o.text||o.value)).length;
    return c >= 4;
  }

  function enforce(sel){
    if(sel._eaStrictDone) return;
    const root = sel.closest('form') || document;
    const prov = currentProviderName(root);
    if(prov && prov.toLowerCase() !== 'petar') { sel._eaStrictDone = true; return; }

    const opts = Array.from(sel.options);
    let first = null;
    opts.forEach(opt=>{
      const t = norm(opt.text || opt.value);
      if(!t) return;
      if(!OK.has(t)) { if(opt.selected) opt.selected=false; opt.remove(); }
      else { if(!first) first = opt; opt.value = t; opt.text = /\./.test(opt.text||'') ? t.replace(':','.') : t; }
    });
    if(!sel.value && first){
      first.selected = true;
      sel.dispatchEvent(new Event('change',{bubbles:true}));
    }
    sel._eaStrictDone = true;
  }

  function scan(){
    document.querySelectorAll('select').forEach(s=>{
      if(looksLikeTimeSelect(s)) enforce(s);
    });
  }

  const mo = new MutationObserver(scan);
  mo.observe(document.body, {childList:true, subtree:true});
  window.addEventListener('DOMContentLoaded', scan);
  scan();
})();
