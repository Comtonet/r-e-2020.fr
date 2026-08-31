document.addEventListener('DOMContentLoaded',()=>{
  const chatCss=document.createElement('link');
  chatCss.rel='stylesheet';
  chatCss.href='/assets/css/keepote-chat.css?v=2';
  document.head.appendChild(chatCss);

  const toggle=document.querySelector('.nav-toggle');
  const nav=document.querySelector('.main-nav');
  if(toggle&&nav){toggle.addEventListener('click',()=>{const open=nav.classList.toggle('open');toggle.setAttribute('aria-expanded',String(open));});}

  const main=document.querySelector('main');
  if(main&&!document.querySelector('.company-signature')){
    const strip=document.createElement('div');
    strip.className='company-signature';
    strip.innerHTML='<div class="container company-signature-inner"><strong>r-e-2020.fr est un site Keeplanet</strong><span>Bureau d\'études basé à Strasbourg · ingénieurs spécialisés en thermique du bâtiment · accompagnement partout en France</span></div>';
    main.parentNode.insertBefore(strip,main);
  }

  const mascot='/assets/img/keepote.png';
  const chatMascot='/assets/img/keepote-tete.png';
  const aiLauncher=document.querySelector('.ai-launcher');
  const aiPanel=document.querySelector('.ai-panel');
  const aiHead=aiPanel?aiPanel.querySelector('.ai-head strong'):null;
  const aiBody=aiPanel?aiPanel.querySelector('.ai-body'):null;
  if(aiLauncher){aiLauncher.innerHTML='<span>✦</span> KeePote';aiLauncher.setAttribute('aria-label','Ouvrir KeePote, l\'assistant Keeplanet');}
  if(aiHead) aiHead.textContent='KeePote · Assistant Keeplanet';
  if(aiBody){
    aiBody.innerHTML='<div class="ai-welcome"><img src="'+chatMascot+'" alt="KeePote"><div><p><strong>Bonjour 👋 Je suis KeePote, l’assistant IA de Keeplanet.</strong></p><p>Vous choisissez : je vous réponds tout de suite, ou notre équipe humaine vous accompagne directement.</p><div class="ai-human-choice"><a href="tel:0806110559">☎ 0 806 110 559</a><a href="mailto:info@keeplanet.fr">✉ info@keeplanet.fr</a></div><div class="ai-note">Je m’appuie sur la documentation validée de Keeplanet. Pour une question sensible ou très spécifique, vous pouvez toujours préférer un thermicien.</div></div></div>';
  }

  const keepoteCopies={
    general:{title:'KeePote ou un humain : vous choisissez.',body:'KeePote est l’assistant IA de Keeplanet, disponible immédiatement pour répondre à vos questions sur la RE2020, vous orienter et expliquer les étapes de votre projet. Et si vous préférez parler à quelqu’un, notre équipe reste tout aussi accessible.'},
    tarifs:{title:'Un doute sur la bonne prestation ? KeePote vous aide tout de suite.',body:'KeePote peut comparer les prestations, expliquer les livrables et vous orienter selon votre projet. Vous gardez toujours le choix : réponse immédiate avec KeePote ou échange direct avec l’équipe Keeplanet.'},
    suivi:{title:'KeePote vous accompagne, nos thermiciens aussi.',body:'KeePote peut vous aider à comprendre un rapport, un indicateur comme le Bbio, le Cep ou le DH, résumer un document et vous guider dans votre dossier. Pour aller plus loin, vous pouvez à tout moment échanger avec un humain.'},
    livrables:{title:'Un document trop technique ? Demandez à KeePote.',body:'KeePote peut reformuler vos résultats et expliquer les principaux indicateurs RE2020. Il est là pour rendre l’information plus accessible, tandis que nos thermiciens restent disponibles dès que vous souhaitez un échange humain.'}
  };

  function makeKeepoteBlock(type){
    const copy=keepoteCopies[type]||keepoteCopies.general;
    const section=document.createElement('section');
    section.className='keepote-block';
    section.innerHTML='<div class="container keepote-inner"><div class="keepote-visual"><img src="'+mascot+'" alt="KeePote, assistant IA Keeplanet"></div><div class="keepote-copy"><span class="eyebrow">KeePote · Assistant IA Keeplanet</span><h2>'+copy.title+'</h2><p>'+copy.body+'</p><div class="keepote-choice"><button class="btn keepote-open" type="button" data-keepote-open>Demander à KeePote</button><div class="keepote-human"><strong>Vous préférez un humain ?</strong><span>Appelez-nous ou écrivez-nous directement.</span><div class="keepote-human-links"><a href="tel:0806110559">☎ 0 806 110 559</a><a href="mailto:info@keeplanet.fr">✉ info@keeplanet.fr</a></div></div></div></div></div>';
    return section;
  }

  function insertKeepote(){
    if(!main||document.querySelector('.keepote-block')) return;
    const path=window.location.pathname;
    if(path.includes('/conditions-generales-de-vente/')||path.includes('/mentions-legales/')||path==='/404/') return;
    let type=null;
    if(path==='/') type='general';
    else if(path.includes('/tarifs-etude-thermique-re-2020/maison-individuelle-extensions')) type='suivi';
    else if(path==='/tarifs-etude-thermique-re-2020/'||path.includes('/tarifs-etude-thermique-re-2020/collectif-tertiaire')) type='tarifs';
    else if(path.includes('/exemples-livrables-re2020')) type='livrables';
    else if(path.includes('/questions-frequentes-re2020')||path.includes('/processus-de-realisation-dune-etude-re2020')||path.includes('/processus-de-realisation/')) type='suivi';
    else type='general';
    const block=makeKeepoteBlock(type);
    const cta=main.querySelector('.cta-band');
    if(cta) main.insertBefore(block,cta); else main.appendChild(block);
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
        <input type="hidden" name="origine" value="site-re2020">
        <input type="hidden" name="choix" value="" data-signup-choice>
        <input type="hidden" name="url_origine" value="${window.location.pathname}">
        <div class="signup-field"><label for="signup-name">Nom</label><input id="signup-name" name="nom" type="text" autocomplete="name" required></div>
        <div class="signup-field"><label for="signup-email">E-mail</label><input id="signup-email" name="email" type="email" autocomplete="email" required></div>
        <div class="signup-field"><label for="signup-phone">Téléphone <span>facultatif</span></label><input id="signup-phone" name="telephone" type="tel" autocomplete="tel"></div>
        <fieldset class="signup-profile"><legend>Vous êtes</legend><label><input type="radio" name="profil" value="particulier" required><span>Particulier</span></label><label><input type="radio" name="profil" value="professionnel" required><span>Professionnel</span></label></fieldset>
        <button class="btn signup-submit" type="submit">Créer mon compte et continuer</button>
        <p class="signup-reassurance">Aucun paiement à cette étape.</p>
      </form>
    </div>`;
  document.body.appendChild(modal);

  const choiceInput=modal.querySelector('[data-signup-choice]');
  const nameInput=modal.querySelector('#signup-name');
  let previousFocus=null;

  function isSignupTrigger(link){
    if(!link||link.hasAttribute('data-no-signup-popup')) return false;
    if(link.matches('[data-signup-trigger]')) return true;
    if(link.closest('header')||link.closest('footer')) return false;
    const text=(link.textContent||'').trim().toLowerCase();
    const href=(link.getAttribute('href')||'').toLowerCase();
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
  function openSignup(link){previousFocus=document.activeElement;if(choiceInput)choiceInput.value=deriveChoice(link);modal.hidden=false;document.documentElement.classList.add('signup-open');window.setTimeout(()=>nameInput&&nameInput.focus(),20);}
  function closeSignup(){modal.hidden=true;document.documentElement.classList.remove('signup-open');if(previousFocus&&typeof previousFocus.focus==='function')previousFocus.focus();}

  document.addEventListener('click',e=>{
    const keepote=e.target.closest('[data-keepote-open]');
    if(keepote&&aiPanel){e.preventDefault();aiPanel.hidden=false;return;}
    const link=e.target.closest('a,button');
    if(link&&isSignupTrigger(link)){e.preventDefault();openSignup(link);return;}
    if(e.target.closest('[data-signup-close]')) closeSignup();
  });
  document.addEventListener('keydown',e=>{if(e.key==='Escape'&&!modal.hidden)closeSignup();});

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