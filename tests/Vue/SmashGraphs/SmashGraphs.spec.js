import { shallowMount } from '@vue/test-utils';
import expect from 'expect';
import SmashGraphs from '../../../resources/js/components/SmashGraphs.vue';
import moxios from 'moxios';
import streamData from './streamData';

describe('SmashGraphs', () => {
  let wrapper;
  beforeEach(() => {
    window.Echo = {
      channel: () => ({
        listen: () => null
      })
    };
    moxios.install(axios);
    wrapper = shallowMount(SmashGraphs, {
        propsData: {
        streamdata: streamData
        }
    });
  });

  afterEach(() => {
    moxios.uninstall(axios);
  });

  it('Renders the stream display name', () => {
    expect(wrapper.html()).toContain('Test Stream');
  });

  it('Renders stream images', () => {
    expect(wrapper.find('img.smashstreams__thumbnail').exists()).toBe(true);
  });

  it('Links to streams', () => {
    expect(wrapper.html()).toContain('<a href="http://test">');
  });

  it('Renders the current viewer count', () => {
    expect(wrapper.find('.smashstreams__graph-label').html()).toContain('125 Viewers');
  });
});
