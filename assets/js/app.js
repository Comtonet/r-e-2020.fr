document.addEventListener('DOMContentLoaded',()=>{
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

  /* KeePote : assistant transversal Keeplanet. */
  const aiLauncher=document.querySelector('.ai-launcher');
  const aiPanel=document.querySelector('.ai-panel');
  const aiHead=aiPanel?aiPanel.querySelector('.ai-head strong'):null;
  const aiBody=aiPanel?aiPanel.querySelector('.ai-body'):null;
  if(aiLauncher){aiLauncher.innerHTML='<span>✦</span> KeePote';aiLauncher.setAttribute('aria-label','Ouvrir KeePote, l\'assistant Keeplanet');}
  if(aiHead) aiHead.textContent='KeePote · Assistant Keeplanet';
  if(aiBody){aiBody.innerHTML='<p><strong>Bonjour 👋 Je suis KeePote, l’assistant Keeplanet.</strong></p><p>Je suis entraîné sur la RE2020 et la documentation validée de Keeplanet. Je peux vous orienter, expliquer des notions réglementaires et, dans votre espace client, vous aider à comprendre vos rapports et documents.</p><div class="ai-note">KeePote complète l’accompagnement de nos thermiciens : l’équipe Keeplanet reste disponible dès que vous avez besoin d’un avis humain.</div>';}

  const keepoteCopies={
    general:{title:'Besoin d’aide ? Demandez à KeePote.',body:'KeePote est l’assistant Keeplanet entraîné sur la RE2020 et notre documentation validée. Il peut vous orienter, expliquer les notions réglementaires et vous aider à comprendre les étapes de votre projet.'},
    tarifs:{title:'Vous hésitez entre plusieurs prestations ? Demandez à KeePote.',body:'KeePote peut vous aider à comprendre les différences entre les packs, les livrables et les étapes de l’étude RE2020. Si votre situation nécessite un avis humain, notre équipe reste bien entendu disponible.'},
    suivi:{title:'KeePote vous accompagne aussi après la commande.',body:'Dans votre espace client, KeePote pourra vous aider à comprendre un rapport, expliquer un indicateur comme le Bbio, le Cep ou le DH, résumer un document et vous guider dans le suivi de votre dossier.'},
    livrables:{title:'Un rapport vous paraît trop technique ? Demandez à KeePote.',body:'KeePote peut vous aider à lire vos documents RE2020, reformuler les résultats et expliquer les principaux indicateurs. Il complète l’accompagnement de Keeplanet ; il ne remplace pas votre thermicien.'}
  };

  function makeKeepoteBlock(type){
    const copy=keepoteCopies[type]||keepoteCopies.general;
    const section=document.createElement('section');
    section.className='keepote-block';
    section.innerHTML='<div class="container keepote-inner"><div class="keepote-icon" aria-hidden="true">✦</div><div class="keepote-copy"><span class="eyebrow">KeePote · Assistant Keeplanet</span><h2>'+copy.title+'</h2><p>'+copy.body+'</p><p class="keepote-human"><strong>Besoin d’un humain ?</strong> Nos thermiciens et l’équipe Keeplanet restent disponibles par téléphone, message ou depuis votre espace client.</p></div><button class="btn keepote-open" type="button" data-keepote-open>Parler à KeePote</button></div>';
    return section;
  }

  function insertKeepote(){
    if(!main||document.querySelector('.keepote-block')) return;
    const path=window.location.pathname;
    let type=null;
    if(path==='/') type='general';
    else if(path.includes('/tarifs-etude-thermique-re-2020/maison-individuelle-extensions')) type='suivi';
    else if(path==='/tarifs-etude-thermique-re-2020/'||path.includes('/tarifs-etude-thermique-re-2020/collectif-tertiaire')) type='tarifs';
    else if(path.includes('/exemples-livrables-re2020')) type='livrables';
    else if(path.includes('/questions-frequentes-re2020')||path.includes('/processus-de-realisation-dune-etude-re2020')) type='suivi';
    if(!type) return;
    const block=makeKeepoteBlock(type);
    const cta=main.querySelector('.cta-band');
    if(cta) main.insertBefore(block,cta);
    else main.appendChild(block);
  }
  insertKeepote();

  /* Popup unique de création de compte.
     Le traitement serveur de /inscription-en-cours/ sera branché ultérieurement. */
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
        <div class="signup-field">
          <label for="signup-name">Nom</label>
          <input id="signup-name" name="nom" type="text" autocomplete="name" required>
        </div>
        <div class="signup-field">
          <label for="signup-email">E-mail</label>
          <input id="signup-email" name="email" type="email" autocomplete="email" required>
        </div>
        <div class="signup-field">
          <label for="signup-phone">Téléphone <span>facultatif</span></label>
          <input id="signup-phone" name="telephone" type="tel" autocomplete="tel">
        </div>
        <fieldset class="signup-profile">
          <legend>Vous êtes</legend>
          <label><input type="radio" name="profil" value="particulier" required><span>Particulier</span></label>
          <label><input type="radio" name="profil" value="professionnel" required><span>Professionnel</span></label>
        </fieldset>
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

  function openSignup(link){
    previousFocus=document.activeElement;
    if(choiceInput) choiceInput.value=deriveChoice(link);
    modal.hidden=false;
    document.documentElement.classList.add('signup-open');
    window.setTimeout(()=>nameInput&&nameInput.focus(),20);
  }
  function closeSignup(){modal.hidden=true;document.documentElement.classList.remove('signup-open');if(previousFocus&&typeof previousFocus.focus==='function') previousFocus.focus();}

  document.addEventListener('click',e=>{
    const keepote=e.target.closest('[data-keepote-open]');
    if(keepote&&aiPanel){e.preventDefault();aiPanel.hidden=false;return;}
    const link=e.target.closest('a,button');
    if(link&&isSignupTrigger(link)){e.preventDefault();openSignup(link);return;}
    if(e.target.closest('[data-signup-close]')) closeSignup();
  });
  document.addEventListener('keydown',e=>{if(e.key==='Escape'&&!modal.hidden) closeSignup();});

  const close=document.querySelector('.ai-close');
  const form=document.querySelector('.ai-form');
  const aiInput=form?form.querySelector('input'):null;
  const aiSubmit=form?form.querySelector('button[type="submit"]'):null;
  const aiHistory=[];
  let aiBusy=false;

  if(aiLauncher&&aiPanel){aiLauncher.addEventListener('click',()=>{aiPanel.hidden=false;if(aiInput)window.setTimeout(()=>aiInput.focus(),20);});}
  if(close&&aiPanel){close.addEventListener('click',()=>{aiPanel.hidden=true;});}

  function appendAiMessage(role,text,extraClass=''){
    if(!aiBody)return null;
    const message=document.createElement('div');
    message.className='ai-message ai-message-'+role+(extraClass?' '+extraClass:'');
    const label=document.createElement('strong');
    label.textContent=role==='user'?'Vous':'KeePote';
    const content=document.createElement('div');
    content.className='ai-message-text';
    content.textContent=text;
    message.appendChild(label);
    message.appendChild(content);
    aiBody.appendChild(message);
    aiBody.scrollTop=aiBody.scrollHeight;
    return message;
  }

  if(form){form.addEventListener('submit',async e=>{
    e.preventDefault();
    if(aiBusy||!aiInput||!aiBody)return;
    const message=aiInput.value.trim();
    if(!message)return;

    if(!aiBody.querySelector('.ai-message'))aiBody.innerHTML='';
    appendAiMessage('user',message);
    aiInput.value='';
    aiBusy=true;
    if(aiSubmit){aiSubmit.disabled=true;aiSubmit.textContent='…';}
    const loading=appendAiMessage('assistant','Je cherche dans la base KeePote…','ai-message-loading');

    try{
      const response=await fetch('/api/keepote.php',{
        method:'POST',
        headers:{'Content-Type':'application/json','Accept':'application/json'},
        credentials:'same-origin',
        body:JSON.stringify({message,history:aiHistory.slice(-8),page:window.location.pathname})
      });
      const data=await response.json().catch(()=>({}));
      if(loading)loading.remove();
      if(!response.ok||!data.ok){throw new Error(data.error||'KeePote est momentanément indisponible.');}
      const answer=String(data.answer||'').trim();
      appendAiMessage('assistant',answer||'Je n’ai pas pu générer de réponse.');
      aiHistory.push({role:'user',text:message},{role:'assistant',text:answer});
      if(aiHistory.length>8)aiHistory.splice(0,aiHistory.length-8);
    }catch(error){
      if(loading&&loading.isConnected)loading.remove();
      appendAiMessage('assistant',error&&error.message?error.message:'Une erreur est survenue. Réessayez dans quelques instants.','ai-message-error');
    }finally{
      aiBusy=false;
      if(aiSubmit){aiSubmit.disabled=false;aiSubmit.textContent='Envoyer';}
      aiInput.focus();
    }
  });}
});