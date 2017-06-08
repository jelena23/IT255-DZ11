import { IT255DZ13Page } from './app.po';

describe('it255-dz13 App', () => {
  let page: IT255DZ13Page;

  beforeEach(() => {
    page = new IT255DZ13Page();
  });

  it('should display message saying app works', () => {
    page.navigateTo();
    expect(page.getParagraphText()).toEqual('app works!');
  });
});
