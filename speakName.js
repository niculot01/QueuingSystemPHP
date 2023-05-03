function speak(name) {
    const msg = new SpeechSynthesisUtterance();
    msg.text = `Customer ${name} is ready to be seated.`;
    window.speechSynthesis.speak(msg);
  }