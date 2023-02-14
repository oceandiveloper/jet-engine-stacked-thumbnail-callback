# Description
Adds new callback to Dynamic Field widget of JetEngine, which allows to return a list of posts thumbnails including post title and permalink to achieve stacked image layout.

# Instructions
1. [Download](https://github.com/oceandiveloper/jet-engine-stacked-thumbnail-callback/archive/refs/heads/main.zip) project zip file.
2. Install & activate plugin in WordPress (needs JetEngine plugin).
3. In dynamic field widget *Source* should be "Post/Term/User/Object Data" and Object Field should be the related items for the current object.
4. Enable option "Filter field output" for dynamic field.
5. Choose as callback "Related post stacked thumbnails".
6. Edit CSS to your liking (see below).

# Change formatting
The styles are based on CSS variables so that you can easily adjust certain formatting without needing to understand CSS. Add the following block to the Custom CSS field of the Dynamic Field widget (Elementor Pro required):

```
selector .jet-rel-list {
  --list-margin-top: calc(var(--image-size) / -2);
  --list-item-offset: -1.875rem;
  --image-size: 5rem;
  --image-hover-transition-width: -0.875rem;
  --image-bg-color: #fff;
  --image-border-color: #fff;
  --image-border-radius: 50%;
  --image-border-width: 4px;
  --tooltip-bg-color: rgba(37, 44, 50, 0.85);
  --tooltip-text-color: #fff;
  --tooltip-text-size: -0.875rem;
  --tooltip-max-width: 8.125rem;
  --plus-count-bg-color: var(--e-global-color-secondary);
  --plus-count-text-color: var(--e-global-color-text);
  --plus-count-text-size: 1rem;
}
```
