(function(){
'use strict';
const id=window.KP_GOOGLE_ADS_ID;
if(!/^AW-\d+$/.test(id||''))return;
const key='kp_ads_consent_v1', lifetime=180*86400000;
let loaded=false, choice='';
window.dataLayer=window.dataLayer||[];
window.gtag=window.gtag||function(){window.dataLayer.push(arguments);};
const g=window.gtag;
const consent=(yes)=>({ad_storage:yes?'granted':'denied',ad_user_data:yes?'granted':'denied',ad_personalization:'denied',analytics_storage:'denied'});
g('consent','default',consent(false));
function read(){
  try{const o=JSON.parse(localStorage.getItem(key)||'null');return o&&o.expires>Date.now()&&['yes','no'].includes(o.choice)?o.choice:'';}catch(_){return '';}
}
function start(){
  if(loaded)return;
  loaded=true;
  g('consent','update',consent(true));
  g('js',new Date());
  g('config',id,{allow_ad_personalization_signals:false});
  const script=document.createElement('script');script.async=true;script.src='https://www.googletagmanager.com/gtag/js?id='+encodeURIComponent(id);
  document.head.appendChild(script);
}
choice=read();
if(choice==='yes')start();
// Appelé exclusivement par les pages de transit après validation serveur.
// La conversion correspond à un formulaire transmis, pas à un compte confirmé.
window.KP_SUBMIT_SIGNUP=function(form,delay){
  if(!form)return;
  let started=false, forwarded=false, timer;
  function forward(){
    if(forwarded)return;
    forwarded=true;window.clearTimeout(timer);
    HTMLFormElement.prototype.submit.call(form);
  }
  function send(){
    if(started)return;
    started=true;
    const label=window.KP_GOOGLE_ADS_SIGNUP_LABEL;
    if(choice!=='yes'||!loaded||!(/^[A-Za-z0-9_-]+$/.test(label||''))){forward();return;}
    // Identifiant aléatoire, sans donnée personnelle, conservé pour cette entrée d'historique.
    let transactionId='';
    try{
      const state=history.state||{};
      transactionId=state.kpAdsLeadId||'';
      if(!transactionId){
        const bytes=new Uint8Array(16);crypto.getRandomValues(bytes);
        transactionId=Array.from(bytes,b=>b.toString(16).padStart(2,'0')).join('');
        history.replaceState(Object.assign({},state,{kpAdsLeadId:transactionId}),'');
      }
    }catch(_){}
    // L'inscription ne doit jamais dépendre de Google ou d'un bloqueur de publicité.
    timer=window.setTimeout(forward,1500);
    const params={send_to:id+'/'+label,event_callback:forward,event_timeout:1200};
    if(transactionId)params.transaction_id=transactionId;
    try{g('event','conversion',params);}catch(_){forward();}
  }
  form.addEventListener('submit',function(e){e.preventDefault();send();});
  window.setTimeout(send,delay||0);
};
function clearAdsCookies(){
  const domains=['',location.hostname,'.'+location.hostname,'.r-e-2020.fr','r-e-2020.fr'];
  document.cookie.split(';').map(s=>s.split('=')[0].trim()).filter(n=>/^_gcl_|^_gac_/.test(n)).forEach(n=>{
    domains.forEach(d=>{document.cookie=n+'=; Max-Age=0; path=/'+(d?'; domain='+d:'')+'; SameSite=Lax';});
  });
}
document.addEventListener('DOMContentLoaded',function(){
  const style=document.createElement('style');
  style.textContent='#kp-ads-consent{position:fixed;bottom:16px;left:16px;z-index:10000;max-width:min(390px,calc(100vw - 32px));padding:16px;background:#fff;color:#26213b;border:1px solid #d9d4e6;border-radius:12px;box-shadow:0 8px 30px #0002;font:14px/1.45 system-ui,sans-serif}#kp-ads-consent[hidden]{display:none!important}#kp-ads-consent p{margin:6px 0 12px}#kp-ads-consent .kp-consent-actions{display:flex;gap:8px;flex-wrap:wrap}#kp-ads-consent button{background:#38227e;color:#fff;border:1px solid #38227e;border-radius:7px;padding:9px 14px;font:inherit;font-weight:600;cursor:pointer}#kp-ads-settings{background:none;border:0;text-decoration:underline;color:inherit;font:inherit;cursor:pointer;padding:5px 0}';
  document.head.appendChild(style);
  const box=document.createElement('section');box.id='kp-ads-consent';box.setAttribute('aria-label','Préférences publicitaires');box.hidden=!!choice;
  box.innerHTML='<strong>Cookies publicitaires</strong><p>Avec votre accord, Google Ads mesure l’efficacité de nos publicités. Vous pouvez accepter ou refuser sans conséquence sur nos services. <a href="/mentions-legales/" data-no-signup-popup>En savoir plus</a>.</p><div class="kp-consent-actions"><button type="button" data-choice="no">Refuser</button><button type="button" data-choice="yes">Accepter</button></div>';
  document.body.appendChild(box);
  const settings=document.createElement('button');settings.id='kp-ads-settings';settings.type='button';settings.textContent='Préférences cookies';
  const footer=document.querySelector('footer');(footer||document.body).appendChild(settings);
  settings.addEventListener('click',()=>{box.hidden=!box.hidden;if(!box.hidden)box.querySelector('button').focus();});
  box.addEventListener('click',e=>{
    const next=e.target.dataset.choice;if(next!=='yes'&&next!=='no')return;
    choice=next;try{localStorage.setItem(key,JSON.stringify({choice,expires:Date.now()+lifetime}));}catch(_){}
    box.hidden=true;
    if(next==='yes'){start();}else{g('consent','update',consent(false));clearAdsCookies();if(loaded){
      // Ne jamais recharger une page de transit POST : cela pourrait renvoyer l'inscription.
      if(location.pathname!=='/inscription-en-cours/')location.reload();
    }}
  });
});
})();
