import { AngularLimitlessPage } from './app.po';

describe('angular-limitless App', () => {
  let page: AngularLimitlessPage;

  beforeEach(() => {
    page = new AngularLimitlessPage();
  });

  it('should display message saying app works', () => {
    page.navigateTo();
    expect(page.getParagraphText()).toEqual('app works!');
  });
});
