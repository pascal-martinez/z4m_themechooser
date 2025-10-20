window.addEventListener("load",function(){new Z4M_ThemeChooser()});class Z4M_ThemeChooser{#extraCodeSelector='#z4m-theme-chooser-extra-code'
#userPanelId='zdk-userpanel-modal'
#appLogoSelector='#zdk-company-logo img'
#bannerLogoSelector='#zdk-header .banner img.title-logo'
#themeButtonClass='choosetheme'
#selectThemeButtonClass='select-theme'
#themeChooserViewName='z4m_theme_chooser'
#themeChooserModalId='z4m-theme-chooser'
#themeTransitionClass='z4m-theme-chooser-transition'
#themes
#isAuthentDisabled=!1;#isAuto=!1
#currentTheme='light'
#isDebug=!1;constructor(){let logAuth=!1;if(z4m.authentication.isEnabled()&&!z4m.authentication.isRequired()){logAuth='User logged in: user\'s preferred theme is applied (\'auto\', \'light\' or \'dark\').';this.#addDisplayButtonInUserPanel();this.#handleClickButtonInUserPanel()}else{this.#isAuthentDisabled=!z4m.authentication.isEnabled()&&!z4m.authentication.isRequired();logAuth=(this.#isAuthentDisabled?'Authentication disabled:':'Login screen:')+' OS or user agent preferred theme applied (\'auto\').'}
const initialThemeName=this.#setThemeInfosFromExtraCode();this.#debug(logAuth);this.#debug('Initial theme is "'+initialThemeName+'".');this.#currentTheme=initialThemeName==='auto'?'light':initialThemeName;this.#applyTheme(initialThemeName);this.#handleSystemPreferredThemeChange()}
getCurrentThemeName(){return this.#currentTheme}
#debug(msg,...args){if(this.#isDebug){const consoleArgs=['Z4M_ThemeChooser - '+msg];if(args.length>0){consoleArgs=consoleArgs.concat(args)}
console.log(...consoleArgs)}}
#triggerThemeChangeEvent(themeName){$('body').trigger('z4mthemechooserchange',themeName)}
#setThemeInfosFromExtraCode(){const extraCodeEl=$(this.#extraCodeSelector),themeName=extraCodeEl.data('theme');this.#themes={dark:extraCodeEl.data('dark'),light:extraCodeEl.data('light')};this.#isDebug=extraCodeEl.data('isdebug')===1;extraCodeEl.remove();return themeName}
#addDisplayButtonInUserPanel(){const myUserRightsButton=$('#'+this.#userPanelId+' button.myuserrights'),themeButton=$(this.#extraCodeSelector+' button');myUserRightsButton.after(themeButton)}
#handleClickButtonInUserPanel(){const $this=this;const themeButton=document.querySelector('#'+this.#userPanelId+' button.'+this.#themeButtonClass);themeButton.addEventListener('click',function(){$this.#showThemeChooserDialog()})}
#handleThemeNameButtonClickEvents(){const $this=this;$('#'+this.#themeChooserModalId).on('click.Z4M_ThemeChooser',function(event){const clickedButton=event.target.closest('button');if(clickedButton&&clickedButton.classList.contains($this.#selectThemeButtonClass)){$this.#selectTheme(clickedButton.dataset.theme)}})}
#handleSystemPreferredThemeChange(){const $this=this;$(window.matchMedia('(prefers-color-scheme: dark)')).on('change.Z4M_ThemeChooser',function(){if($this.#isAuto){$this.#applyTheme('auto')}})}
#showThemeChooserDialog(){const $this=this;const userPanelObj=z4m.modal.make('#'+this.#userPanelId);const doesModalExistInDom=document.getElementById(this.#themeChooserModalId)!==null;z4m.modal.make('#'+this.#themeChooserModalId,this.#themeChooserViewName,function(){userPanelObj.close();$this.#addCheckIconToThemeButtons();this.open();if(!doesModalExistInDom){$this.#handleThemeNameButtonClickEvents()}})}
#closeThemeChooserDialog(){const modal=z4m.modal.make('#'+this.#themeChooserModalId);modal.close()}
#getThemeButtons(){return document.querySelectorAll('#'+this.#themeChooserModalId+' button.'+this.#selectThemeButtonClass)}
#addCheckIconToThemeButtons(){const selectedThemeName=this.#isAuto?'auto':this.getCurrentThemeName();const buttons=this.#getThemeButtons();for(let i=0;i<buttons.length;++i){let button=buttons[i];let themeName=button.dataset.theme;let checkIcon=button.querySelector('i.fa-check');if(themeName===selectedThemeName){checkIcon.classList.remove('w3-hide');button.disabled=!0}else{checkIcon.classList.add('w3-hide');button.disabled=!1}}}
#getSelectedThemeLink(){const theme=this.getCurrentThemeName(),themeLink=$('link[href*="'+this.#themes[theme].css+'"]');return themeLink.length>0?themeLink:!1}
#selectTheme(themeName){const $this=this;this.#storeNewThemeForUser(themeName,function(){$this.#closeThemeChooserDialog();$this.#applyTheme(themeName)})}
#setBodyDataThemeName(themeName){this.#debug('Current theme is "'+themeName+'".');$('body').attr('data-theme',themeName);this.#currentTheme=themeName}
#getAutoThemeName(){const prefersDarkScheme=window.matchMedia("(prefers-color-scheme: dark)");return prefersDarkScheme.matches?'dark':'light'}
async #setNewThemeLogo(themeName){if(this.#themes[themeName].hasOwnProperty('icon')){const $this=this,logoSelectors=[$this.#appLogoSelector,$this.#bannerLogoSelector];let success=!0;for(const logoSelector of logoSelectors){success&&=await new Promise(function(resolve){$(logoSelector)[0].onload=function(){resolve(!0)};$(logoSelector)[0].onerror=function(){resolve(!1)};$(logoSelector).attr('src',$this.#themes[themeName].icon)});if(success){$this.#debug('Theme logo loading succeeded for \''+themeName+'\' theme and \''+logoSelector+'\' element.')}else{console.error('Theme logo loading failed for \''+themeName+'\' theme and \''+logoSelector+'\' element.')}}
return success}else{return!1}}
#applyTheme(themeName){this.#isAuto=themeName==='auto';if(themeName==='auto'){themeName=this.#getAutoThemeName()}
if(this.getCurrentThemeName()===themeName){this.#setBodyDataThemeName(themeName);this.#debug('The theme "'+themeName+'" is already the current theme. Nothing is done.');return}
const currentThemeLinkEl=this.#getSelectedThemeLink();if(currentThemeLinkEl===!1){console.error('Z4M_ThemeChooser - Unable to retrieve the current theme URL.');return}
const $this=this,themeLinkParent=currentThemeLinkEl.parent(),newThemeLink=$('<link rel="stylesheet" type="text/css"/>');newThemeLink[0].onload=async function(){$this.#debug('Theme "'+themeName+'" is loaded.');currentThemeLinkEl.remove();const logoLoading=await $this.#setNewThemeLogo(themeName);if(logoLoading===!0){$this.#debug('Theme\'s logos for theme "'+themeName+'" are loaded.')}
$this.#applyThemeTransition(!1);$this.#setBodyDataThemeName(themeName);$this.#triggerThemeChangeEvent(themeName)};newThemeLink[0].onerror=function(){$this.#applyThemeTransition(!1)};this.#debug('New theme to apply is "'+themeName+'".');this.#applyThemeTransition(!0);newThemeLink.attr('href',this.#themes[themeName].css+'?v='+this.#themes[themeName].fileversion);themeLinkParent.append(newThemeLink)}
#applyThemeTransition(start){const transitionClass=this.#themeTransitionClass;if(start){z4m.ajax.toggleLoader(!0);document.documentElement.classList.add(transitionClass)}else{z4m.ajax.toggleLoader(!1);window.setTimeout(function(){document.documentElement.classList.remove(transitionClass)},2000)}}
#storeNewThemeForUser(themeName,successCallback){const modal=z4m.modal.make('#'+this.#themeChooserModalId);z4m.ajax.request({controller:'Z4mThemeChooserCtrl',action:'store',data:{new_theme:themeName},callback:function(response){modal.getInnerForm().hideError();if(response.success){successCallback();z4m.messages.showSnackbar(response.msg)}else{modal.getInnerForm().showError(response.msg)}}})}}