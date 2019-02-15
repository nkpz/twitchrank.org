import { shallowMount } from "@vue/test-utils";
import expect from "expect";
import SmashGraphs from "../../../resources/js/components/SmashGraphs.vue";
import moxios from "moxios";

describe("SmashGraphs", () => {
  beforeEach(() => {
    window.Echo = {
        channel: () => ({
            listen: () => null,
        }),
    }
    moxios.install(axios);
  });

  afterEach(() => {
    moxios.uninstall(axios);
  });

  it("Renders the stream's display name", () => {
    let wrapper = shallowMount(SmashGraphs, {
        propsData: {
            streamdata: JSON.stringify([
                {
                    thumbnail: 'http://test',
                    url: 'http://test',
                    display_name: 'Test Stream',
                    name: 'teststream',
                    id: 1,
                    stats: [
                        [1550179755,123],
                        [1550179815,125],
                    ]
                }
            ])
        }
    });
    expect(wrapper.html()).toContain("Test Stream");
  });
});
