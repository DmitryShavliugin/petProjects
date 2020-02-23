using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace Builder_Pattern.Ducks
{
    class ExoticDuck : DuckBase
    {
        public override void Display()
        {
            Console.WriteLine("I'm an exotic Duck!");
        }
    }
}
