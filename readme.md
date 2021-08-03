# fullPage - flatCore Theme

This Theme is build on top of fullPage.js by Alvaro Trigo.
https://github.com/alvarotrigo/fullPage.js


## How it works

Upload the fullPage directory in your Themes folder. At this point there is no drag & drop installation. You will probably adjust the CSS anyway, so that doesn't make any sense either. You have to install the theme via (S)FTP.

![snippets](https://user-images.githubusercontent.com/5982156/127913012-947191da-0352-4ebd-a711-263dd65902de.png)
All the Sections and Slides must be saved as Snippets. Create a label to be able to assign the sections and slides. In this example it's `fullPage`

![edit_snippet](https://user-images.githubusercontent.com/5982156/127913006-a11cf9c3-d9ea-422c-baa5-8efa6de2877b.png)
Use the field Keywords to create a Section or Slide.

| Keyword | |
|---------|----|
| section | creates a section |
| slide slide2 | creates a slide in the second section |

All Sections and Slides will be sorted by the field __Priority__

![page](https://user-images.githubusercontent.com/5982156/128049373-077dd5f0-c99b-4b1a-8fb7-e292563ff96a.png)
Create a new Page, choose fullPage - layout_default.tpl as Specific Template

Include your Sections and Slides via Shortcode `[fullPage=yourLabel]`

Section:
![preview1](https://user-images.githubusercontent.com/5982156/127912993-75ade93b-206c-4306-a5c6-15d2692ef8c9.png)

Slide:
![preview2](https://user-images.githubusercontent.com/5982156/127912983-22c426ff-4c04-4c0d-88bf-28fb60020232.png)

### License

#### Commercial license
If you want to use fullPage to develop non open sourced sites, themes, projects, and applications, the Commercial license is the appropriate license. With this option, your source code is kept proprietary. Which means, you won't have to change your whole application source code to an open source license. [Purchase a Fullpage Commercial License](https://alvarotrigo.com/fullPage/pricing/)

#### Open source license
You can use fullPage.js for your Open Source Project under the terms of the [GPLv3](https://www.gnu.org/licenses/gpl-3.0.html).

### Questions? Suggestions? Ideas?

Please use the discussion function in our main repository on GitHub: https://github.com/flatCore/flatCore-CMS/discussions

### Contribution

You are very welcome to take part in this project. We are happy for every contribution!
