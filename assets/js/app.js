document.addEventListener('DOMContentLoaded',()=>{
  const chatCss=document.createElement('link');
  chatCss.rel='stylesheet';
  chatCss.href='/assets/css/keepote-chat.css?v=2';
  document.head.appendChild(chatCss);

  const toggle=document.querySelector('.nav-toggle');
  const nav=document.querySelector('.main-nav');
  if(toggle&&nav){toggle.addEventListener('click',()=>{const open=nav.classList.toggle('open');toggle.setAttribute('aria-expanded',String(open));});}

  const main=document.querySelector('main');
  // L’identité KeePlanet est directement intégrée au header PHP.

  const mascot='/assets/img/keepote.png';
  const chatMascot='/assets/img/keepote-tete.png';
  const aiLauncher=document.querySelector('.ai-launcher');
  const aiPanel=document.querySelector('.ai-panel');
  const aiHead=aiPanel?aiPanel.querySelector('.ai-head strong'):null;
  const aiBody=aiPanel?aiPanel.querySelector('.ai-body'):null;
  if(aiLauncher){aiLauncher.innerHTML='<span>✦</span> KeePote';aiLauncher.setAttribute('aria-label','Ouvrir KeePote, l\'assistant Keeplanet');}
  if(aiHead) aiHead.textContent='KeePote · Assistant Keeplanet';
  if(aiBody){
    aiBody.innerHTML='<div class="ai-welcome"><img src="'+chatMascot+'" alt="KeePote"><div><p><strong>Bonjour 👋 Je suis KeePote, l’assistant IA de Keeplanet.</strong></p><p>Posez-moi une question générale sur la RE2020. Vous pouvez aussi joindre directement notre équipe :</p><div class="ai-human-choice"><a href="tel:0806110559">☎ 0 806 110 559</a><a href="mailto:info@keeplanet.fr">✉ info@keeplanet.fr</a></div><div class="ai-note">Pour les questions propres à votre étude, nos thermiciens sont à votre disposition.</div></div></div>';
  }

  // L'assistant est toujours accessible dans le chat ; ne pas multiplier les promotions.
  function insertKeepote(){
    if(!main||document.querySelector('.keepote-block,.kp-editorial-support,.tarifs-help-section,.kee-pote-promo'))return;
    const path=window.location.pathname;
    if(!/^\/(exemples-livrables-re2020|questions-frequentes-re2020)\/?$/.test(path))return;
    const block=document.createElement('section');
    block.className='kp-editorial-support';
    block.innerHTML='<div class="container kp-editorial-support-inner"><div><h2>Une question sur votre étude ?</h2><p>Notre équipe est à votre disposition par téléphone et par e-mail. Vous pouvez aussi poser une question générale à KeePote.</p><div class="kp-editorial-contact"><a href="tel:0806110559">0806 110 559</a><a href="mailto:info@keeplanet.fr">info@keeplanet.fr</a><button class="kp-editorial-chat" type="button" data-keepote-open>Poser une question à KeePote →</button></div></div></div>';
    const cta=main.querySelector('.cta-band');
    if(cta)main.insertBefore(block,cta);else main.appendChild(block);
  }
  insertKeepote();

  const modal=document.createElement('div');
  modal.className='signup-modal';
  modal.hidden=true;
  modal.innerHTML=`
    <div class="signup-modal-backdrop" data-signup-close></div>
    <div class="signup-modal-dialog" role="dialog" aria-modal="true" aria-labelledby="signup-title">
      <button class="signup-modal-close" type="button" aria-label="Fermer" data-signup-close>×</button>
      <div class="signup-modal-brand">r-e-2020.fr <span>× Keeplanet</span></div>
      <h2 id="signup-title">Créez votre compte pour continuer</h2>
      <p class="signup-modal-intro">Quelques secondes suffisent. Vous pourrez ensuite déposer vos documents et poursuivre votre demande depuis votre espace sécurisé.</p>
      <form class="signup-form" method="post" action="/inscription-en-cours/">
        <input type="hidden" name="_kp_signup_flow" value="general">
        <input type="hidden" name="origine" value="site-re2020">
        <input type="hidden" name="choix" value="" data-signup-choice>
        <input type="hidden" name="offre_exit_maison" value="" data-signup-exit-offer>
        <input type="hidden" name="url_origine" value="${window.location.pathname}">
        <input type="hidden" name="devis_payload" value="" data-signup-devis-payload>
        <input type="hidden" name="devis_depuis_calculateur" value="" data-signup-devis-flag>
        <input type="hidden" name="public_signup" value="" data-signup-public-signup>
        <div class="signup-field"><label for="signup-name">Nom</label><input id="signup-name" name="nom" type="text" autocomplete="name" required></div>
        <div class="signup-field"><label for="signup-email">E-mail</label><input id="signup-email" name="email" type="email" autocomplete="email" required></div>
        <div class="signup-field"><label for="signup-phone">Téléphone <span>facultatif</span></label><input id="signup-phone" name="telephone" type="tel" autocomplete="tel"></div>
        <fieldset class="signup-profile"><legend>Vous êtes</legend><label><input type="radio" name="profil" value="particulier" required><span>Particulier</span></label><label><input type="radio" name="profil" value="professionnel" required><span>Professionnel</span></label></fieldset>
        <div class="signup-field"><label for="signup-company">Société <span>facultatif</span></label><input id="signup-company" name="societe" type="text" autocomplete="organization"></div>
        <div class="signup-field"><label for="signup-address">Adresse</label><input id="signup-address" name="adresse" type="text" autocomplete="street-address" required></div>
        <div class="signup-form-row"><div class="signup-field"><label for="signup-zip">Code postal</label><input id="signup-zip" name="code_postal" type="text" inputmode="numeric" autocomplete="postal-code" required></div><div class="signup-field"><label for="signup-city">Ville</label><input id="signup-city" name="ville" type="text" autocomplete="address-level2" required></div></div>
        <button class="btn signup-submit" type="submit">Créer mon compte et continuer</button>
        <p class="signup-reassurance">Aucun paiement à cette étape.</p>
      </form>
    </div>`;
  document.body.appendChild(modal);

  const choiceInput=modal.querySelector('[data-signup-choice]');
  const exitOfferInput=modal.querySelector('[data-signup-exit-offer]');
  const quotePayloadInput=modal.querySelector('[data-signup-devis-payload]');
  const quoteFlagInput=modal.querySelector('[data-signup-devis-flag]');
  const publicSignupInput=modal.querySelector('[data-signup-public-signup]');
  const nameInput=modal.querySelector('#signup-name');
  let pendingQuotePayload='';
  let pendingQuoteChoice='';
  const houseExitOffer=document.querySelector('[data-house-exit-offer]');
  const houseExitOfferCta=houseExitOffer?houseExitOffer.querySelector('[data-house-exit-claim]'):null;
  const HOUSE_EXIT_SEEN_KEY='re2020-house-exit-offer-seen-v1';
  let previousFocus=null;
  let houseExitOfferPreviousFocus=null;
  let houseExitOfferShown=false;

  function houseExitAlreadySeen(){
    try{return sessionStorage.getItem(HOUSE_EXIT_SEEN_KEY)==='1';}catch(_e){return houseExitOfferShown;}
  }
  function markHouseExitSeen(){
    houseExitOfferShown=true;
    try{sessionStorage.setItem(HOUSE_EXIT_SEEN_KEY,'1');}catch(_e){}
  }
  function openHouseExitOffer(){
    if(!houseExitOffer||houseExitAlreadySeen()||!modal.hidden||!houseExitOffer.hidden||document.querySelector('#kp-house-dialog[open]')||(aiPanel&&!aiPanel.hidden))return;
    houseExitOfferPreviousFocus=document.activeElement;
    markHouseExitSeen();
    houseExitOffer.hidden=false;
    document.documentElement.classList.add('house-exit-open');
    window.setTimeout(()=>houseExitOfferCta&&houseExitOfferCta.focus(),20);
  }
  function closeHouseExitOffer(){
    if(!houseExitOffer||houseExitOffer.hidden)return;
    houseExitOffer.hidden=true;
    document.documentElement.classList.remove('house-exit-open');
    if(houseExitOfferPreviousFocus&&typeof houseExitOfferPreviousFocus.focus==='function')houseExitOfferPreviousFocus.focus();
  }

  function isSignupTrigger(link){
    if(!link||link.hasAttribute('data-no-signup-popup')) return false;
    if(link.matches('[data-signup-trigger]')) return true;
    if(link.closest('header')||link.closest('footer')) return false;
    const text=(link.textContent||'').trim().toLowerCase();
    const href=(link.getAttribute('href')||'').toLowerCase();
    if(href.startsWith('#')||href.startsWith('mailto:')||href.startsWith('tel:')||/\.pdf(?:[?#]|$)/.test(href))return false;
    const signupWords=['je lance mon étude','lancer mon étude','démarrer mon étude','démarrer','choisir cette formule','choisir ce pack','choisir','cliquer ici','créer mon compte','créer votre compte','s’inscrire','s\'inscrire','inscription','ouvrir mon dossier','commencer mon étude','commander'];
    if(signupWords.some(word=>text.includes(word))) return true;
    if(href.includes('espace-client.keeplanet.fr')&&link.closest('main')&&!text.includes('accéder à mon espace')&&!text.includes('espace client')) return true;
    return false;
  }
  function deriveChoice(link){
    const explicit=link.getAttribute('data-signup-choice');
    if(explicit) return explicit;
    const pack=link.closest('.house-pack,.price-card,.card,.pricing-choice');
    if(pack){const title=pack.querySelector('h2,h3');if(title) return title.textContent.trim();}
    return (link.textContent||'').trim();
  }
  function openSignup(link){
    previousFocus=document.activeElement;
    const isQuoteSignup=link&&link.getAttribute&&link.getAttribute('data-quote-signup')==='1';
    if(choiceInput)choiceInput.value=isQuoteSignup&&pendingQuoteChoice?pendingQuoteChoice:deriveChoice(link);
    if(quotePayloadInput)quotePayloadInput.value=isQuoteSignup?pendingQuotePayload:'';
    if(quoteFlagInput)quoteFlagInput.value=isQuoteSignup&&pendingQuotePayload?'1':'';
    if(publicSignupInput)publicSignupInput.value=isQuoteSignup&&pendingQuotePayload?'1':'';
    const acceptedExitOffer=link.getAttribute('data-signup-exit-offer')==='1';
    if(exitOfferInput)exitOfferInput.value=acceptedExitOffer?'1':'';
    if(acceptedExitOffer)markHouseExitSeen();
    closeHouseExitOffer();
    modal.hidden=false;
    document.documentElement.classList.add('signup-open');
    window.setTimeout(()=>nameInput&&nameInput.focus(),20);
  }
  function closeSignup(){modal.hidden=true;document.documentElement.classList.remove('signup-open');if(previousFocus&&typeof previousFocus.focus==='function')previousFocus.focus();}

  if(houseExitOffer&&!houseExitAlreadySeen()){
    const finePointer=window.matchMedia('(hover: hover) and (pointer: fine)').matches;
    if(finePointer){
      window.setTimeout(()=>{
        document.addEventListener('mouseout',e=>{
          if(e.clientY<=8&&!e.relatedTarget)openHouseExitOffer();
        });
      },5000);
    }else{
      const packs=document.querySelector('#packs');
      let lastY=window.scrollY;
      let upwardDistance=0;
      const mobileStartedAt=Date.now();
      window.addEventListener('scroll',()=>{
        if(!packs||houseExitAlreadySeen())return;
        const y=window.scrollY;
        const reachedPacks=y>Math.max(300,packs.offsetTop-120);
        if(!reachedPacks){lastY=y;return;}
        if(y<lastY)upwardDistance+=lastY-y;else upwardDistance=0;
        lastY=y;
        if(Date.now()-mobileStartedAt>10000&&upwardDistance>=220)openHouseExitOffer();
      },{passive:true});
    }
  }

  document.addEventListener('re2020:open-signup',e=>{
    const detail=e.detail||{};
    try{pendingQuotePayload=JSON.stringify(detail.payload||{});}catch(_e){pendingQuotePayload='';}
    pendingQuoteChoice=String(detail.choice||'Devis RE2020');
    const trigger=document.createElement('button');
    trigger.type='button';
    trigger.setAttribute('data-signup-trigger','');
    trigger.setAttribute('data-quote-signup','1');
    trigger.setAttribute('data-signup-choice',pendingQuoteChoice);
    openSignup(trigger);
  });

  document.addEventListener('click',e=>{
    if(e.target.closest('[data-house-exit-close]')){e.preventDefault();closeHouseExitOffer();return;}
    const keepote=e.target.closest('[data-keepote-open]');
    if(keepote&&aiPanel){e.preventDefault();aiPanel.hidden=false;return;}
    const link=e.target.closest('a,button');
    if(link&&isSignupTrigger(link)){e.preventDefault();openSignup(link);return;}
    if(e.target.closest('[data-signup-close]')) closeSignup();
  });
  document.addEventListener('keydown',e=>{
    if(e.key!=='Escape')return;
    if(houseExitOffer&&!houseExitOffer.hidden){closeHouseExitOffer();return;}
    if(!modal.hidden)closeSignup();
  });

  const close=document.querySelector('.ai-close');
  const form=document.querySelector('.ai-form');
  const aiInput=form?form.querySelector('input'):null;
  const aiSubmit=form?form.querySelector('button[type="submit"]'):null;
  const aiHistory=[];
  let aiBusy=false;

  if(aiLauncher&&aiPanel){aiLauncher.addEventListener('click',()=>{aiPanel.hidden=false;if(aiInput)window.setTimeout(()=>aiInput.focus(),20);});}
  if(close&&aiPanel){close.addEventListener('click',()=>{aiPanel.hidden=true;});}

  function escapeHtml(value){
    return String(value).replace(/[&<>"']/g,ch=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;',"'":'&#039;'}[ch]));
  }

  function renderMarkdown(text){
    let src=escapeHtml(String(text||'')).replace(/\\\*\\\*/g,'**').replace(/\\-/g,'-');
    src=src.replace(/\*\*(.+?)\*\*/g,'<strong>$1</strong>').replace(/__(.+?)__/g,'<strong>$1</strong>');
    src=src.replace(/`([^`]+)`/g,'<code>$1</code>');
    // Recognize Markdown and bare links to our calculator, including escaped brackets.
    // One pass; the output anchor is never parsed as another input URL.
    const quoteLink='<a class="ai-quote-link" href="/devis-en-ligne/" data-no-signup-popup>Calculer mon devis en ligne <span aria-hidden="true">→</span></a>';
    src=src.replace(/\\?\[[^\]\r\n]{1,180}\\?\]\\?\(\s*(?:&lt;)?(?:https?:\/\/(?:www\.)?r-e-2020\.fr)?\/devis-en-ligne\/?(?:&gt;)?\s*\\?\)|https?:\/\/(?:www\.)?r-e-2020\.fr\/devis-en-ligne\/?(?![\w/?#-])/gi,()=>quoteLink);
    const lines=src.split(/\r?\n/);
    let html='';
    let listType=null;
    function closeList(){if(listType){html+='</'+listType+'>';listType=null;}}
    lines.forEach(line=>{
      const trimmed=line.trim();
      let m=trimmed.match(/^[-•]\s+(.+)$/);
      if(m){if(listType!=='ul'){closeList();html+='<ul>';listType='ul';}html+='<li>'+m[1]+'</li>';return;}
      m=trimmed.match(/^\d+[.)]\s+(.+)$/);
      if(m){if(listType!=='ol'){closeList();html+='<ol>';listType='ol';}html+='<li>'+m[1]+'</li>';return;}
      closeList();
      if(!trimmed){html+='<div class="ai-spacer"></div>';return;}
      if(/^###\s+/.test(trimmed)){html+='<p><strong>'+trimmed.replace(/^###\s+/,'')+'</strong></p>';return;}
      if(/^##?\s+/.test(trimmed)){html+='<p><strong>'+trimmed.replace(/^##?\s+/,'')+'</strong></p>';return;}
      html+='<p>'+trimmed+'</p>';
    });
    closeList();
    return html;
  }

  function appendAiMessage(role,text,extraClass=''){
    if(!aiBody)return null;
    const message=document.createElement('div');
    message.className='ai-message ai-message-'+role+(extraClass?' '+extraClass:'');
    if(role==='assistant'){
      const avatar=document.createElement('div');
      avatar.className='ai-avatar';
      avatar.innerHTML='<img src="'+chatMascot+'" alt="">';
      message.appendChild(avatar);
    }
    const wrap=document.createElement('div');
    wrap.className='ai-message-wrap';
    const label=document.createElement('span');
    label.className='ai-message-author';
    label.textContent=role==='user'?'Vous':'KeePote';
    const content=document.createElement('div');
    content.className='ai-message-text';
    content.innerHTML=role==='assistant'?renderMarkdown(text):'<p>'+escapeHtml(text)+'</p>';
    wrap.appendChild(label);wrap.appendChild(content);message.appendChild(wrap);aiBody.appendChild(message);aiBody.scrollTop=aiBody.scrollHeight;return message;
  }

  function appendThinking(){
    if(!aiBody)return null;
    const message=document.createElement('div');
    message.className='ai-message ai-message-assistant ai-thinking';
    message.innerHTML='<div class="ai-avatar"><img src="'+chatMascot+'" alt=""></div><div class="ai-message-wrap"><span class="ai-message-author">KeePote</span><div class="ai-message-text"><span class="keepote-infinity" aria-hidden="true"></span><span class="keepote-thinking-label">KeePote réfléchit…</span></div></div>';
    aiBody.appendChild(message);aiBody.scrollTop=aiBody.scrollHeight;return message;
  }

  if(form){form.addEventListener('submit',async e=>{
    e.preventDefault();
    if(aiBusy||!aiInput||!aiBody)return;
    const message=aiInput.value.trim();
    if(!message)return;
    if(!aiBody.querySelector('.ai-message'))aiBody.innerHTML='';
    appendAiMessage('user',message);aiInput.value='';aiBusy=true;if(aiSubmit)aiSubmit.disabled=true;
    const loading=appendThinking();
    try{
      const response=await fetch('/api/keepote.php',{method:'POST',headers:{'Content-Type':'application/json','Accept':'application/json'},credentials:'same-origin',body:JSON.stringify({message,history:aiHistory.slice(-8),page:window.location.pathname})});
      const data=await response.json().catch(()=>({}));
      if(loading)loading.remove();
      if(!response.ok||!data.ok)throw new Error(data.error||'KeePote est momentanément indisponible.');
      const answer=String(data.answer||'').trim();
      appendAiMessage('assistant',answer||'Je n’ai pas pu générer de réponse.');
      aiHistory.push({role:'user',text:message},{role:'assistant',text:answer});
      if(aiHistory.length>8)aiHistory.splice(0,aiHistory.length-8);
    }catch(error){
      if(loading&&loading.isConnected)loading.remove();
      appendAiMessage('assistant',error&&error.message?error.message:'Une erreur est survenue. Réessayez dans quelques instants.','ai-message-error');
    }finally{aiBusy=false;if(aiSubmit)aiSubmit.disabled=false;aiInput.focus();}
  });}
});