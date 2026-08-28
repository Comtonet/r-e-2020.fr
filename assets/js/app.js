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
    if(pack){
      const title=pack.querySelector('h2,h3');
      if(title) return title.textContent.trim();
    }
    return (link.textContent||'').trim();
  }

  function openSignup(link){
    previousFocus=document.activeElement;
    if(choiceInput) choiceInput.value=deriveChoice(link);
    modal.hidden=false;
    document.documentElement.classList.add('signup-open');
    window.setTimeout(()=>nameInput&&nameInput.focus(),20);
  }

  function closeSignup(){
    modal.hidden=true;
    document.documentElement.classList.remove('signup-open');
    if(previousFocus&&typeof previousFocus.focus==='function') previousFocus.focus();
  }

  document.addEventListener('click',e=>{
    const link=e.target.closest('a,button');
    if(link&&isSignupTrigger(link)){
      e.preventDefault();
      openSignup(link);
      return;
    }
    if(e.target.closest('[data-signup-close]')) closeSignup();
  });

  document.addEventListener('keydown',e=>{if(e.key==='Escape'&&!modal.hidden) closeSignup();});

  const launch=document.querySelector('.ai-launcher');
  const panel=document.querySelector('.ai-panel');
  const close=document.querySelector('.ai-close');
  const form=document.querySelector('.ai-form');
  if(launch&&panel){launch.addEventListener('click',()=>{panel.hidden=false;});}
  if(close&&panel){close.addEventListener('click',()=>{panel.hidden=true;});}
  if(form){form.addEventListener('submit',e=>{e.preventDefault();const body=document.querySelector('.ai-body');if(body){body.innerHTML='<p><strong>Le chatbot sera connecté à la base IA validée lors de la prochaine étape.</strong></p><p>Pour le moment, vous pouvez contacter directement un thermicien au <a href="tel:0806110559">0806 110 559</a>.</p>';}});}
});